<?php

class AjaxstoregiftsControllerBase extends UTIController
{
	
	public function index()
	{
	
		$result = $this->renderPartial('index',NULL, TRUE);
		
		 echo $result;
    }  
	
	public function GetFirst()
	{
		$criteria = new CDbCriteria();
		$criteria->order = 'price';
		$criteria->limit = 30;
		$model = GiftsProducts::model()->with('lang')->findAll($criteria);
		
		$result = array();
		
		foreach($model as $value)
		{
			$result[] = array(
				'id' => $value->id,
				'name' => $value->lang->name,
				'currency' => Yii::t('app','Дарики'),
				'price' => $value->price,
				'status' => $value->status,
			);
		}

		echo CJSON::encode($result);
    }
	
	public function slider()
	{
	
		$result = $this->renderPartial('slider',NULL, TRUE);
		
		 echo $result;
    }  
	
	public function products()
	{
	
		$result = $this->renderPartial('products',NULL, TRUE);
		
		 echo $result;
    }  
	
	public function createProducts()
	{
	
		$result = $this->renderPartial('formproducts',NULL, TRUE);
		
		 echo $result;
    }
	
	public function viewProducts()
	{
	
		$result = $this->renderPartial('viewproducts',NULL, TRUE);
		
		 echo $result;
    }
	
	
	public function updateProducts()
	{
	
		$result = $this->renderPartial('updateroducts',NULL, TRUE);
		
		 echo $result;
    }
	
	public static function getStatus($value)
	{
		switch ($value) {
			case 1:
				return array('id' => 1, 'name' => 'Активный ');
				break;
			case 0:
				return array('id' => 0, 'name' => 'Не активный');
				break;
			case 2:
				return array('id' => 2, 'name' => 'Удаленный');
				break;
		}
	}
	
	public function GetGiftsProducts()
	{
		$model = GiftsProducts::model()->with('lang')->findAll();
		
		$result = array();
		
		foreach($model as $value)
		{
		
			$result[] = array(
				'id' => $value->id,
				'name' => $value->lang->name,
				'currency' => Yii::t('app','Дарики'),
				'price' => $value->price,
				'status' => self::getStatus($value->status),
			);
		}

		echo CJSON::encode($result);
    }
	
	
	public function GetGiftsProductsDESC()
	{
		$criteria = new CDbCriteria();
		$criteria->order = 'price DESC';
		
		$model = GiftsProducts::model()->with('lang')->findAll($criteria);
		
		$result = array();
		
		foreach($model as $value)
		{
		
			$result[] = array(
				'id' => $value->id,
				'name' => $value->lang->name,
				'currency' => Yii::t('app','Дарики'),
				'price' => $value->price,
				'status' => self::getStatus($value->status),
			);
		}

		echo CJSON::encode($result);
    }
	
	public function CreateGiftsProducts()
	{
		if(empty(Yii::app()->request->csrfToken))
		{
			throw new CHttpException('403', 'Ошибочный запрос, отказано в доступе.');
		}
		$params = CJSON::decode(file_get_contents('php://input'), true);
		
		$error = TRUE;
		$errors = array();
		
		$store = new GiftsProducts();
		$store->article = $params['data']['article'];
		$store->status = $params['data']['status'];
		$store->price = $params['data']['price'];
		if($store->validate())
		{
			$store->save();
			
			$lang = new GiftsProductsLang();
			$lang->product__id = $store->id;
			$lang->lang = 'ru';
			$lang->name = $params['data']['name'];
			$lang->description = $params['data']['description'];
			$lang->order_description = $params['data']['orderdescr'];
			$lang->brief_text = $params['data']['description'];
			$lang->meta_keywords = array_key_exists('metakeywords', $params['data'])? $params['data']['metakeywords'] : '';
			$lang->meta_description = array_key_exists('metadescr', $params['data'])? $params['data']['metadescr'] : '';
			if($lang->validate())
			{
				$lang->save();
				$error = FALSE;
			}
			else
			{
				$errors['errors'] = $lang->getErrors();
				GiftsProducts::sendResponse(500, $errors['errors']);
			}
		}
		else
		{
			$errors['errors'] = $store->getErrors();
			GiftsProducts::sendResponse(500, $errors['errors']);
		}
		
		$errors['id'] = $store->id;
		
		 echo CJSON::encode($errors);
    }
	
	public function UpdateGiftsProducts()
	{
		if(empty(Yii::app()->request->csrfToken))
		{
			throw new CHttpException('403', 'Ошибочный запрос, отказано в доступе.');
		}
		$params = CJSON::decode(file_get_contents('php://input'), true);
		
		$error = TRUE;
		$errors = array();
		
		if($params['scenario'] == 'update')
		{
			$store = GiftsProducts::model()->with('lang')->findByPk($params['data'][0]['id']);
			
			$store->article = $params['data'][0]['article'];
			$store->status = is_array($params['data'][0]['status'])? $params['data'][0]['status']['id']: $params['data'][0]['status'];
			$store->price = $params['data'][0]['price'];
			if($store->validate())
			{
				
				if(!$store->save())
				{
					throw new CHttpException('500', 'Ошибка обновления подарка');
				}
				
				$store->lang->name = $params['data'][0]['name'];
				$store->lang->description = $params['data'][0]['description'];
				$store->lang->order_description = $params['data'][0]['orderdescr'];
				$store->lang->brief_text = $params['data'][0]['description'];
				$store->lang->meta_keywords = $params['data'][0]['metakeywords'];
				$store->lang->meta_description = $params['data'][0]['metadescr'];
				if($store->lang->validate())
				{
					if(!$store->lang->save())
					{
						throw new CHttpException('500', 'Ошибка обновления подарка');
					}
					$error = FALSE;
				}
				else
				{
					$errors['errors'] = $store->lang->getErrors();
					GiftsProducts::sendResponse(500, $errors['errors']);
				}
			}
			else
			{
				$errors['errors'] = $store->getErrors();
				GiftsProducts::sendResponse(500, $errors['errors']);
			}
		}
		else
		{
			$store = GiftsProducts::model()->with('lang')->findByPk($params['data']['id']);
			
			$store->article = $params['data']['article'];
			$store->status = $params['data']['status'];
			$store->price = $params['data']['price'];
			if($store->validate())
			{
				$store->save();
				
				$store->lang->name = $params['data']['name'];
				$store->lang->description = $params['data']['description'];
				$store->lang->order_description = $params['data']['orderdescr'];
				$store->lang->brief_text = $params['data']['description'];
				$store->lang->meta_keywords = array_key_exists('metakeywords', $params['data']) ? $params['data']['metakeywords']: '';
				$store->lang->meta_description = array_key_exists('metadescr', $params['data']) ? $params['data']['metadescr']: '';
				if($store->lang->validate())
				{
					if(!$store->lang->save())
					{
						throw new CHttpException('500', 'Ошибка обновления подарка');
					}
					$error = FALSE;
				}
				else
				{
					$errors['errors'] = $store->lang->getErrors();
					GiftsProducts::sendResponse(500, $errors['errors']);
				}
			}
			else
			{
				$errors['errors'] = $store->getErrors();
				GiftsProducts::sendResponse(500, $errors['errors']);
			}
		}
		
		 echo CJSON::encode($errors);
    }
	
	public function DeleteGiftsProducts()
	{
		if(empty(Yii::app()->request->csrfToken))
		{
			throw new CHttpException('403', 'Ошибочный запрос, отказано в доступе.');
		}
		$params = CJSON::decode(file_get_contents('php://input'), true);
			
		$store = GiftsProducts::model()->with('lang')->findByPk($params['data']);
		
		$error = TRUE;
		$errors = array();
		
		$store->status = 2;
		if($store->validate())
		{
			$store->save();
			$error = FALSE;
		}
		
		$errors['product'] = $store->getErrors();
		
		 echo CJSON::encode($errors);
    }
	
	public function DeleteAttachmentsProducts()
	{
		if(empty(Yii::app()->request->csrfToken))
		{
			throw new CHttpException('403', 'Ошибочный запрос, отказано в доступе.');
		}
		$params = CJSON::decode(file_get_contents('php://input'), true);
		Yii::import('application.modules.attachment.models.*');			
		$attachment = Attachments::model()->findByPk($params['data']);
		
		$error = TRUE;
		$errors = array();
		
		$attachment->delete();
		
		$errors['attachment'] = $attachment->getErrors();
		
		 echo CJSON::encode($errors);
    }
	
	public function UpdateMainProducts()
	{
		if(empty(Yii::app()->request->csrfToken))
		{
			throw new CHttpException('403', 'Ошибочный запрос, отказано в доступе.');
		}
		$params = CJSON::decode(file_get_contents('php://input'), true);
		
		$title_picture = $params['picture'];
		$product_id = $params['id'];
		$product = GiftsProducts::model()->findByPk($product_id);
		
		$error = TRUE;
		$errors = array();
		
		$product->title_picture__id = $title_picture;
		if(!$product->save())
		{
			throw new CHttpException('500', 'Ошибка обновления главного изображения');
		}
		
		$errors['products'] = $product->getErrors();
		
		 echo CJSON::encode($errors);
    }
	
	public function ViewGiftsProducts()
	{
	
		if(empty(Yii::app()->request->csrfToken))
		{
			throw new CHttpException('403', 'Ошибочный запрос, отказано в доступе.');
		}
		$params = CJSON::decode(file_get_contents('php://input'), true);
		Yii::import('application.modules.attachment.models.*');	
		$value = GiftsProducts::model()->with('lang')->findByPk($params['data']['id']);
		
		$result = array();
		$images = array();
		foreach($value->attachments as $attach)
		{
			$images[] = array(
				'id' => $attach->id,
				'url' => strstr($attach->full_path,'/upload'),
				'title' => $attach->orig_name,
			);
		}
		$file_path = '';
		if($value->mainAttachment instanceof Attachments)
		{
			$file_path = strstr($value->mainAttachment->full_path,'/upload');
		}
		$result[] = array(
				'id' => $value->id,
				'lang' => $value->lang->lang,
				'article' => $value->article,
				'description' => $value->lang->description,
				'orderdescr' => $value->lang->order_description,
				'description' => $value->lang->brief_text,
				'metakeywords' => $value->lang->meta_keywords,
				'metadescr' => $value->lang->meta_description,
				'name' => $value->lang->name,
				'currency' => Yii::t('app','Дарики'),
				'price' => $value->price,
				'status' => self::getStatus($value->status),
				'images' => $images,
				'main_img' =>$file_path
			);

		echo CJSON::encode($result);
    }

	public function GetGiftsHorders()
	{
		$result = $this->renderPartial('horders',NULL, TRUE);
		
		 echo $result;
    }
	
	  
	
	public function edit()
	{
	
		$result = $this->renderPartial('edit',NULL, TRUE);
		
		 echo $result;
    }    
	
	public function create()
	{
	
		$result = $this->renderPartial('create',NULL, TRUE);
		
		 echo $result;
    }    
	
	public function GetStatuses()
	{
		$result = array(); 
		
		$result[0] = array(
			'id' => 1,
			'alias' => 'active',
			'name' => 'Активный '
		);
		$result[1] = array(
			'id' => 0,
			'alias' => 'notactive',
			'name' => 'Не активный'
		);
		$result[2] = array(
			'id' => 2,
			'alias' => 'deleted',
			'name' => 'Удаленный'
		);
        echo CJSON::encode($result);

    }    
	
	public function uploadFiles()
	{
		Yii::import('application.modules.attachment.models.*');
		Yii::import('application.modules.attachment.helpers.*');
				
		if ( !empty( $_FILES ) ) 
		{
			$params = $_POST;
			$result = Attachments::model()->saveFile('office_photo', $params['value'], 'file', 'office_photo', 'office_photo');
			$answer = array( 'answer' => 'File transfer completed' );
			$json = json_encode( $result );

			echo $json;
		}
		else
		{
			echo 'No files';
		}
		
	}
   
}