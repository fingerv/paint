<?php

/**
 * This is the model class for table "printers".
 *
 * The followings are the available columns in table 'printers':
 * @property integer $id
 * @property string $brand
 * @property string $model
 * @property string $scheme
 * @property string $logo
 */
class Printer extends CActiveRecord
{
	public $schemeSelection = array();
	public $colorSelection = array();
	public $colorsList = array();

	public $supportedSchemes = array(
		'CMYK' => 'CMYK',
		'CMYKLcLm' => 'CMYKLcLm',
		'CMYKLcLmOrGr' => 'CMYKLcLmOrGr',
	);

	public $additionalColors = array(
		'W' => 'W',
		'V' => 'V',
		'P' => 'P',
		'F' => 'F',
	);
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Printer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'printers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('brand, model, schemeSelection', 'required'),
			array('brand, model, scheme, logo', 'length', 'max'=>255),
			array('colorSelection', 'validateColors'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, brand, model, logo, colorSelection, schemeSelection', 'safe', 'on'=>'search'),

			array('logo', 'file', 'allowEmpty'=>true, 'types' => array('jpeg', 'gif', 'png', 'jpg'), 'maxSize' => 1024 * 1024, )
		);
	}

	public function validateColors()
	{
		if(!$this->hasErrors() && !empty($this->colorSelection)) {
			foreach($this->colorSelection as $color)
			{
				if(!in_array($color, $this->additionalColors))
					$this->addError('colorSelection', 'Incorrect colors selected');
			}
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	public function afterFind()
	{
		foreach(explode(",", $this->scheme) as $element)
		{
			if(in_array($element, $this->supportedSchemes))
			{
				$this->schemeSelection[] = $element;
			}
			elseif(in_array($element, $this->additionalColors))
			{
				$this->colorSelection[] = $element;
			}
		}

		// extracting colors from printer color scheme and merging it with additional colors (if any)
		$this->colorsList = array_merge(self::extractColors($this->schemeSelection), $this->colorSelection);

		parent::afterFind();
	}

	public function beforeSave()
	{
		$this->scheme = implode(",", array_merge((array)$this->schemeSelection, $this->colorSelection));

		$file = CUploadedFile::getInstance($this, 'logo');
		if($file)
		{
			$ext = $file->getExtensionName();

			$fileName = uniqid('file_') . '.' . $ext;
			$filePath = Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $fileName;

			if($file->saveAs($filePath)) {
				ImgHelper::resize($filePath, 300, 200);
				$this->logo = $fileName;
			}
		}

		return parent::beforeSave();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'brand' => 'Бренд',
			'model' => 'Модель',
			'scheme' => 'Поддерживаемые схемы',
			'schemeSelection' => 'Поддерживаемые схемы',
			'colorSelection' => 'Дополнительные цвета',
			'logo' => 'Лого принтера',
		);
	}

	public function findPaints()
	{
		$conditions = array();
		foreach($this->colorsList as $color) {
			$conditions[] = " $color IS NOT NULL ";
		}

		$sql = "SELECT * FROM paints WHERE " . implode(" OR ", $conditions);

		$result = array();
		$reader = Yii::app()->db->createCommand($sql)->query();

		while($row = $reader->read())
			$result[$row['id']] = $row;

		return $result;
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('brand',$this->brand,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('scheme',$this->scheme,true);
		$criteria->compare('logo',$this->logo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function extractColors($schemes)
	{
		$colors = array();
		foreach($schemes as $scheme) {
			$colors = array_merge($colors, self::parseScheme($scheme));
		}

		return array_unique($colors);
	}

	public static function parseScheme($scheme)
	{
		$matches = array();
		preg_match_all('/[A-Z]{1}[a-z]?/', $scheme, $matches);

		return $matches[0];
	}
}