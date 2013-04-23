<?php

/**
 * This is the model class for table "heads".
 *
 * The followings are the available columns in table 'heads':
 * @property integer $id
 * @property string $brand
 * @property string $model
 * @property string $class
 */
class Head extends CActiveRecord
{
	public $classes = array(
		'A' => 'Класс А',
		'B' => 'Класс B',
		'C' => 'Класс C',
	);

	public $colorsList = array('C','M','Y', 'K','Lc','Lm','Or','Gr', 'W', 'V', 'P', 'F');
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Head the static model class
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
		return 'heads';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('brand, model, class', 'required'),
			array('brand, model, class', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, brand, model, class', 'safe', 'on'=>'search'),
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

	public function findPaints()
	{
		$sql = 'SELECT * FROM paints WHERE LOWER(class) = :class';

		$reader = Yii::app()->db->createCommand($sql)->query(array('class' => strtolower($this->class)));

		$result = array();
		while($row = $reader->read())
			$result[$row['id']] = $row;

		return $result;
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
			'class' => 'Класс',
		);
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
		$criteria->compare('class',$this->class,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}