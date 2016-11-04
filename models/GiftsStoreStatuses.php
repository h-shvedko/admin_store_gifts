<?php

/**
 * This is the model class for table "gifts_store_statuses".
 *
 * The followings are the available columns in table 'gifts_store_statuses':
 * @property integer $id
 * @property string $alias
 * @property string $name
 * @property string $created_at
 * @property integer $created_by
 * @property string $created_ip
 * @property string $modified_at
 * @property integer $modified_by
 * @property string $modified_ip
 */
class GiftsStoreStatuses extends UTIActiveRecord
{
	const STATUS_NEW = 'new';
	const STATUS_PROCESSED = 'processed';
	const STATUS_DELIVERY = 'delivery';
	const STATUS_EXECUTED = 'executed';
	const STATUS_DECLINED = 'rejected';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GiftsStoreStatuses the static model class
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
		return 'gifts_store_statuses';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('alias, name, created_at, modified_at', 'required'),
			array('created_by, modified_by', 'numerical', 'integerOnly'=>true),
			array('alias', 'length', 'max'=>255),
			array('name', 'length', 'max'=>50),
			array('created_ip, modified_ip', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, alias, name, created_at, created_by, created_ip, modified_at, modified_by, modified_ip', 'safe', 'on'=>'search'),
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
			'alias' => 'Alias',
			'name' => 'Name',
			'created_at' => 'Created At',
			'created_by' => 'Created By',
			'created_ip' => 'Created Ip',
			'modified_at' => 'Modified At',
			'modified_by' => 'Modified By',
			'modified_ip' => 'Modified Ip',
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
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_ip',$this->created_ip,true);
		$criteria->compare('modified_at',$this->modified_at,true);
		$criteria->compare('modified_by',$this->modified_by);
		$criteria->compare('modified_ip',$this->modified_ip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getNewStatus()
	{
		return GiftsStoreStatuses::model()->find('alias = :alias', array(':alias' => self::STATUS_NEW));
	}
	
	public static function getProcessedStatus()
	{
		return GiftsStoreStatuses::model()->find('alias = :alias', array(':alias' => self::STATUS_PROCESSED));
	}
	
	public static function getDeliveryStatus()
	{
		return GiftsStoreStatuses::model()->find('alias = :alias', array(':alias' => self::STATUS_DELIVERY));
	}
	
	public static function getExecutedStatus()
	{
		return GiftsStoreStatuses::model()->find('alias = :alias', array(':alias' => self::STATUS_EXECUTED));
	}
	
	public static function getStatusesByPk($id)
	{
		$model = GiftsStoreStatuses::model()->findByPk($id);
		$result = array();

		if($model instanceof GiftsStoreStatuses)
		{
			$result[] = array(
				'id' => $model->id,
				'name' => $model->name,
			);
		}
		
		return $result;
	}
	
}