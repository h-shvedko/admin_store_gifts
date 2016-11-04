<?php

/**
 * This is the model class for table "gifts_store_horders".
 *
 * The followings are the available columns in table 'gifts_store_horders':
 * @property integer $id
 * @property string $num
 * @property integer $users__id
 * @property double $total_price
 * @property string $commentary
 * @property integer $is_payed
 * @property integer $war_warehouse__id
 * @property string $closed_at
 * @property string $declined_at
 * @property string $created_at
 * @property integer $created_by
 * @property string $created_ip
 * @property string $modified_at
 * @property integer $modified_by
 * @property string $modified_ip
 */
class GiftsStoreHorders extends UTIActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GiftsStoreHorders the static model class
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
		return 'gifts_store_horders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('users__id, is_payed, war_warehouse__id, created_by, modified_by', 'numerical', 'integerOnly'=>true),
			array('status', 'numerical', 'integerOnly'=>true, 'message' => 'Заполните статус заказа'),
			array('status', 'required', 'message' => 'Заполните статус заказа'),
			array('total_price', 'numerical'),
			array('num', 'length', 'max'=>24),
			array('created_ip, modified_ip', 'length', 'max'=>100),
			array('commentary, closed_at, declined_at, created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, num, users__id, total_price, commentary, is_payed, status, war_warehouse__id, closed_at, declined_at, created_at, created_by, created_ip, modified_at, modified_by, modified_ip', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		Yii::import('application.modules.register.models.*');
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'orders' => array(self::HAS_MANY, 'GiftsStoreOrders', 'gifts_horders__id'),
			'users' => array(self::BELONGS_TO, 'Users', 'users__id'),
			'war_warehouse' => array(self::BELONGS_TO, 'WarWarehouse', 'war_warehouse__id'),
			'statuses' => array(self::BELONGS_TO, 'GiftsStoreStatuses', 'status'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'num' => 'Num',
			'users__id' => 'Users',
			'total_price' => 'Total Price',
			'commentary' => 'Commentary',
			'is_payed' => 'Is Payed',
			'status' => 'Status',
			'war_warehouse__id' => 'War Warehouse',
			'closed_at' => 'Closed At',
			'declined_at' => 'Declined At',
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
		$criteria->compare('num',$this->num,true);
		$criteria->compare('users__id',$this->users__id);
		$criteria->compare('total_price',$this->total_price);
		$criteria->compare('commentary',$this->commentary,true);
		$criteria->compare('is_payed',$this->is_payed);
		$criteria->compare('war_warehouse__id',$this->war_warehouse__id);
		$criteria->compare('closed_at',$this->closed_at,true);
		$criteria->compare('declined_at',$this->declined_at,true);
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
	
	public static function getNum($id)
	{
		return 'G'.app_date('dmy').'-'.$id;
	}
	
	public  function createInvoiceOrder($horder, $stausAlias)
	{
		
		Yii::import('application.modules.store.models.*');
		Yii::import('application.modules.admin.modules.invoice.models.WarHordersType');
		Yii::import('application.modules.admin.modules.invoice.models.WarHordersTypeLang');
		Yii::import('application.modules.admin.modules.invoice.models.WarHordersStatus');
		Yii::import('application.modules.admin.modules.invoice.models.WarHordersStatusLang');	
		Yii::import('application.modules.admin.modules.invoice.models.WarOrders');	
		Yii::import('application.modules.admin.modules.invoice.models.WarHorders');
		Yii::import('application.modules.admin.modules.warehouse.models.*');
		
		$modelHorder = new WarHorders();

		$modelHorder->number = WarHorders::getNum();
				
		$modelType = WarHordersType::model()->find('alias = :alias', array(':alias' => 'orders')); //заказ
		$modelHorder->type__id = $modelType->id;
		$modelStatus = WarHordersStatus::model()->find('alias = :alias', array(':alias' => $stausAlias)); 
		$modelHorder->status__id = $modelStatus->id;
		//not_conducted - не проведен
		//held - проведен
		//shipped - отгружен	
		
		$modelHorder->object_alias_from = 'warehouse'; //склад
		$modelHorder->object_id_from = $horder->war_warehouse__id;
		$modelHorder->object_alias_to = 'user'; //пользователь
		$modelHorder->object_id_to = $horder->users__id;
		$modelHorder->finance_transactions__id = $horder->id;
		$modelHorder->date = app_date('Y.m.d H:i:s');
		$modelHorder->amount = $horder->total_price;
		if(!$modelHorder->save())
		{
			throw new CException('Ошибка содания накладной');
		}
		

		foreach ($horder->orders as $key => $value)
		{
			$modelOrder = new WarOrders();
			$modelOrder->horder__id = $modelHorder->id;
			$modelOrder->product__id = $value->gifts_products__id;
			$modelOrder->count = $value->count;
			$modelOrder->price = $value->price;
			if(!$modelOrder->save())
			{
				throw new CException('Ошибка содания тела накладной');
			}
		}
		return TRUE;
	}
	
	public static function getCountGiftsHorders($userId = FALSE)
	{
		if($userId == FALSE)
		{
			throw new CException('Ошибка, пустой идентификатор пользователя');
		}
		
		$criteria = new CDbCriteria();
		$criteria->condition = 'users__id = :users__id and status = :status';
		$criteria->params = array(':users__id' => $userId, ':status' => GiftsStoreStatuses::getNewStatus()->id);
		
		$model = (int)FALSE;
		$model = GiftsStoreHorders::model()->count($criteria);
		
		return $model;
	}
	
	public static function getGiftsHorders($userId = FALSE)
	{
		if($userId == FALSE)
		{
			throw new CException('Ошибка, пустой идентификатор пользователя');
		}
		
		$criteria = new CDbCriteria();
		$criteria->condition = 'users__id = :users__id and status = :status';
		$criteria->params = array(':users__id' => $userId, ':status' => GiftsStoreStatuses::getNewStatus()->id);
		
		$model = (int)FALSE;
		$model = GiftsStoreHorders::model()->findAll($criteria);
		
		return $model;
	}
	
	public function updateStatus($storeHorders)
	{
		if(!($storeHorders instanceof Horders))
		{
			throw new CException('Ошибка, нет данных для обновления заказа подарков');
		}
		
		$criteria = new CDbCriteria();
		$criteria->condition = 'store_horders__id = :store_horders__id';
		$criteria->params = array(':store_horders__id' => $storeHorders->id);
		
		$horders = array();
		$horders = GiftsStoreHorders::model()->findAll($criteria);
		
		$result = TRUE;
		
		foreach($horders as $horder)
		{
			if($storeHorders->status == 1)
			{
				$horder->status = GiftsStoreStatuses::getProcessedStatus()->id;
			}
			elseif($storeHorders->status == 2)
			{
				$horder->status = GiftsStoreStatuses::getDeliveryStatus()->id;
			}
			elseif($storeHorders->status == 3)
			{
				$horder->status = GiftsStoreStatuses::getExecutedStatus()->id;
				$horder->closed_at = app_date("Y-m-d H:i:s");
			}
			elseif($storeHorders->status == 4)
			{
				$horder->status = GiftsStoreStatuses::getNewStatus()->id;
			}
			
			if($horder->save())
			{
				$result = TRUE&&$result;
			}
		}
		return $result;
	}
	
	public static function isBelongToGifts($war_horders)
	{
		$model = GiftsStoreHorders::model()->findByPk($war_horders->finance_transactions__id);
		
		if(($model instanceof GiftsStoreHorders) && $model->total_price == $war_horders->amount && 
			$model->created_at == $war_horders->created_at && $model->users__id == $war_horders->object_id_to && 
			$war_horders->object_alias_to == 'user')
		{
			return TRUE;
		}
		return FALSE;
	}
}