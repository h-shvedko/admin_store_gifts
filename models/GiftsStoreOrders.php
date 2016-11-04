<?php

/**
 * This is the model class for table "gifts_store_orders".
 *
 * The followings are the available columns in table 'gifts_store_orders':
 * @property integer $id
 * @property integer $gifts_horders__id
 * @property integer $gifts_products__id
 * @property integer $count
 * @property double $price
 * @property string $created_at
 * @property integer $created_by
 * @property string $created_ip
 * @property string $modified_at
 * @property integer $modified_by
 * @property string $modified_ip
 */
class GiftsStoreOrders extends UTIActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GiftsStoreOrders the static model class
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
		return 'gifts_store_orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gifts_horders__id, gifts_products__id, count, created_by, modified_by', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('created_ip, modified_ip', 'length', 'max'=>100),
			array('created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, gifts_horders__id, gifts_products__id, count, price, created_at, created_by, created_ip, modified_at, modified_by, modified_ip', 'safe', 'on'=>'search'),
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
			'horders' => array(self::BELONGS_TO, 'GiftsStoreHorders', 'gifts_horders__id'),
			'products' => array(self::BELONGS_TO, 'GiftsProducts', 'gifts_products__id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'gifts_horders__id' => 'Gifts Horders',
			'gifts_products__id' => 'Gifts Products',
			'count' => 'Count',
			'price' => 'Price',
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
		$criteria->compare('gifts_horders__id',$this->gifts_horders__id);
		$criteria->compare('gifts_products__id',$this->gifts_products__id);
		$criteria->compare('count',$this->count);
		$criteria->compare('price',$this->price);
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
}