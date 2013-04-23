<?php

/**
 * This is the model class for table "paints".
 *
 * The followings are the available columns in table 'paints':
 * @property integer $id
 * @property string $brand
 * @property string $class
 * @property string $C
 * @property string $M
 * @property string $Y
 * @property string $K
 * @property string $Lc
 * @property string $Lm
 * @property string $Or
 * @property string $Gr
 * @property string $W
 * @property string $V
 * @property string $P
 * @property string $F
 */
class Paint extends CActiveRecord
{
	public $classes = array(
		'A' => 'Класс А',
		'B' => 'Класс B',
		'C' => 'Класс C',
	);

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Paint the static model class
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
		return 'paints';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('brand, class', 'required'),
			array('brand, class, C, M, Y, K, Lc, Lm, Or, Gr, W, V, P, F', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, brand, class, C, M, Y, K, Lc, Lm, Or, Gr, W, V, P, F', 'safe', 'on'=>'search'),
		);
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'brand' => 'Brand',
			'class' => 'Class',
			'C' => 'C',
			'M' => 'M',
			'Y' => 'Y',
			'K' => 'K',
			'Lc' => 'Lc',
			'Lm' => 'Lm',
			'Or' => 'Or',
			'Gr' => 'Gr',
			'W' => 'W',
			'V' => 'V',
			'P' => 'P',
			'F' => 'F',
		);
	}

	public $colors = array(
		'C',
		'M',
		'Y',
		'K',
		'Lc',
		'Lm',
		'Or',
		'Gr',
		'W',
		'V',
		'P',
		'F',
	);
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
		$criteria->compare('class',$this->class,true);
		$criteria->compare('C',$this->C,true);
		$criteria->compare('M',$this->M,true);
		$criteria->compare('Y',$this->Y,true);
		$criteria->compare('K',$this->K,true);
		$criteria->compare('Lc',$this->Lc,true);
		$criteria->compare('Lm',$this->Lm,true);
		$criteria->compare('Or',$this->Or,true);
		$criteria->compare('Gr',$this->Gr,true);
		$criteria->compare('W',$this->W,true);
		$criteria->compare('V',$this->V,true);
		$criteria->compare('P',$this->P,true);
		$criteria->compare('F',$this->F,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave()
	{
		$uniqueId = uniqid('file_');
		foreach($this->colors as $attribute)
		{
			$file = CUploadedFile::getInstance($this, $attribute);
			if($file)
			{
				$fileName = $uniqueId . '_' . $attribute . '.' . $file->getExtensionName();
				$filePath = Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $fileName;

				if($file->saveAs($filePath)) {
					ImgHelper::resize($filePath, 300, 200);
					$this->$attribute = $fileName;
				}
			}
		}

		return parent::beforeSave();
	}

	public function getAvailableColorImagesCount()
	{
		$count = 0;
		foreach($this->colors as $color) {
			if(!empty($this->$color))
				$count++;
		}

		return $count;
	}


}