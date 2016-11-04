<?php

class AjaxordergiftsControllerBase extends UTIController
{
	
	public function index()
	{
	
		$result = $this->renderPartial('index',NULL, TRUE);
		
		 echo $result;
    }  
	
	
	public function horders()
	{
	
		$result = $this->renderPartial('horders',NULL, TRUE);
		
		 echo $result;
    }  
	
	
	public function viewHorders()
	{
	
		$result = $this->renderPartial('viewhorders',NULL, TRUE);
		
		 echo $result;
    }
	
	
	public function updateHorders()
	{
	
		$result = $this->renderPartial('updatehorders',NULL, TRUE);
		
		 echo $result;
    }
	
	public function GetGiftsHorders()
	{
		$criteria = new CDbCriteria();
		$criteria->order = 't.id DESC';
		
		$model = GiftsStoreHorders::model()->with('orders')->findAll($criteria);
		
		$result = array();
		
		foreach($model as $value)
		{
			$username = empty($value->users)? '': $value->users->username;
			$userFIO = '';
			if(!empty($value->users->profile->lang))
			{
				$userFIO .= $value->users->profile->lang->last_name. ' ' .$value->users->profile->lang->first_name. ' ' .  $value->users->profile->lang->second_name;
			}
			$result[] = array(
				'id' => $value->id,
				'num' => $value->num,
				'username' => $username,
				'FIO' => $userFIO,
				'total_price' => $value->total_price,
				'status' => empty($value->status) ? '' :  GiftsStoreStatuses::getStatusesByPk($value->status), 
				'is_payed' => $value->is_payed == (int)FALSE ? 'Не оплачен' : 'Оплачен ',
				'created_at' => date("Y-m-d", strtotime($value->created_at)),
			);
		}

		echo CJSON::encode($result);
    }
	
	public function GetStatuses()
	{
		$model = GiftsStoreStatuses::model()->findAll();
		
		$result = array();
		
		foreach($model as $value)
		{
			$result[] = array(
				'id' => $value->id,
				'alias' => $value->alias,
				'name' => $value->name,
			);
		}

		echo CJSON::encode($result);
    }
	
	
	public function GetPay()
	{
		$result[0] = array(
				'id' => (int)FALSE,
				'alias' => 'notpaid',
				'name' => 'Не оплачен',
			);
			
		$result[1] = array(
				'id' => (int)TRUE,
				'alias' => 'paid',
				'name' => 'Оплачен ',
			);
		
		echo CJSON::encode($result);
    }
	
	
	public function UpdateGiftsHorders()
	{
		if(empty(Yii::app()->request->csrfToken))
		{
			throw new CHttpException('403', 'Ошибочный запрос, отказано в доступе.');
		}
		$params = CJSON::decode(file_get_contents('php://input'), true);
			
		$store = GiftsStoreHorders::model()->findByPk($params['data'][0]['id']);
		
		$error = TRUE;
		$errors = array();
		
		$store->status = $params['data'][0]['status'][0];
		$store->commentary = $params['data'][0]['commentary'];

		if($store->validate())
		{
			if(!$store->save())
			{
				throw new CHttpException('500', 'Ошибка обновления подарка');
			}
		}
		else
		{
			$errors['errors'] = $store->getErrors();
			GiftsProducts::sendResponse(500, $errors['errors']);
		}
		
		if($store->statuses->alias == GiftsStoreStatuses::STATUS_EXECUTED)
		{
			$store->closed_at = app_date("Y-m-d H:i:s");
			$store->declined_at = NULL;
			$store->save();
		}
		elseif($store->statuses->alias == GiftsStoreStatuses::STATUS_DECLINED)
		{
			$store->declined_at = app_date("Y-m-d H:i:s");
			$store->closed_at = NULL;
			$store->save();
		}
		else
		{
			$store->declined_at = NULL;
			$store->closed_at = NULL;
			$store->save();
		}
	
	    echo CJSON::encode($errors);
    }
		
	public function ViewGiftsHorders()
	{
	
		if(empty(Yii::app()->request->csrfToken))
		{
			throw new CHttpException('403', 'Ошибочный запрос, отказано в доступе.');
		}
		$params = CJSON::decode(file_get_contents('php://input'), true);
	
		$value = GiftsStoreHorders::model()->with('orders')->findByPk($params['data']['id']);
				
		$result = array();
		$orderss = array();
		foreach($value->orders as $order)
		{
			$orderss[] = array(
				'id' => $order->id,
				'price' => $order->price,
				'count' => $order->count,
				'total_price' => $order->price*$order->count,
				'product_name' => $order->products->lang->name,
				'product_article' => $order->products->article,
				'product_descr' =>$order->products->lang->order_description,
			);
		}
		
		$result[] = array(
				'id' => $value->id,
				'num' => $value->num,
				'status' => !empty($value->statuses) ? GiftsStoreStatuses::getStatusesByPk($value->status) : '',
				'username' => $value->users->username,
				'commentary' => $value->commentary,
				'name' => $value->users->profile->lang->first_name.' '.$value->users->profile->lang->first_name.' '.$value->users->profile->lang->first_name,
				'orders' => $orderss,
				'total_price' => $value->total_price,
				'created_at' => !empty($value->created_at) ? date("d.m.Y", strtotime($value->created_at)) : '',
				'closed_at' => !empty($value->closed_at) ? date("d.m.Y", strtotime($value->closed_at)) : '',
				'declined_at' => !empty($value->declined_at) ? date("d.m.Y", strtotime($value->declined_at)) : '',
			);

		echo CJSON::encode($result);
    }
	
	public function edit()
	{
	
		$result = $this->renderPartial('edit',NULL, TRUE);
		
		 echo $result;
    }    
	
	
}