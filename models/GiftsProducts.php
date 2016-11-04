<?php

/**
 * This is the model class for table "gifts_products".
 *
 * The followings are the available columns in table 'gifts_products':
 * @property integer $id
 * @property string $article
 * @property integer $status
 * @property integer $title_picture__id
 * @property string $price
 * @property integer $created_by
 * @property string $created_at
 * @property string $created_ip
 * @property string $modified_at
 * @property integer $modified_by
 * @property string $modified_ip
 */
class GiftsProducts extends UTIActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GiftsProducts the static model class
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
		return 'gifts_products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('price', 'required', 'message' => 'Введите цену для подарка'),
			array('status', 'required', 'message' => 'Введите статус для подарка'),
			array('article', 'required', 'message' => 'Введите артикул для подарка'),
			array('status, title_picture__id, created_by, modified_by', 'numerical', 'integerOnly'=>true),
			array('article', 'length', 'max'=>255),
			array('article', 'unique', 'message'=>'Такой артикул товара уже существует, введите другой'),
			array('price', 'length', 'max'=>20),
			array('created_ip, modified_ip', 'length', 'max'=>100),
			array('created_at, modified_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, article, status, title_picture__id, price, created_by, created_at, created_ip, modified_at, modified_by, modified_ip', 'safe', 'on'=>'search'),
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
			'lang' => array(self::HAS_ONE, 'GiftsProductsLang', 'product__id', 'condition' => 'lang=:lang', 'params' => array(':lang' => Yii::app()->language)),
			'attachments' => array(self::HAS_MANY, 'Attachments', 'object_id'),
			'mainAttachment' => array(self::HAS_ONE, 'Attachments', 'object_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'article' => 'Article',
			'status' => 'Status',
			'title_picture__id' => 'Title Picture',
			'price' => 'Price',
			'created_by' => 'Created By',
			'created_at' => 'Created At',
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
		$criteria->compare('article',$this->article,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('title_picture__id',$this->title_picture__id);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('created_ip',$this->created_ip,true);
		$criteria->compare('modified_at',$this->modified_at,true);
		$criteria->compare('modified_by',$this->modified_by);
		$criteria->compare('modified_ip',$this->modified_ip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function sendResponse($status = 200, $body = '', $content_type = 'text/html')
	{
		GiftsProducts::model()->_sendResponse($status, $body, $content_type);
	}
	
	private function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
	{
		// set the status
		$status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
		header($status_header);
		// and the content type
		header('Content-type: ' . $content_type);
	 
		// pages with body are easy
		if($body != '')
		{
			// send the body
			 echo CJSON::encode($body);
		}
		// we need to create the body if none is passed
		else
		{
			// create some body messages
			$message = '';
	 
			// this is purely optional, but makes the pages a little nicer to read
			// for your users.  Since you won't likely send a lot of different status codes,
			// this also shouldn't be too ponderous to maintain
			switch($status)
			{
				case 401:
					$message = 'You must be authorized to view this page.';
					break;
				case 404:
					$message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
					break;
				case 500:
					$message = 'The server encountered an error processing your request.';
					break;
				case 501:
					$message = 'The requested method is not implemented.';
					break;
			}
	 
			// servers don't always have a signature turned on 
			// (this is an apache directive "ServerSignature On")
			$signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];
	 
			// this should be templated in a real-world solution
			$body = '
				<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
				<html>
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
					<title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
				</head>
				<body>
					<h1>' . $this->_getStatusCodeMessage($status) . '</h1>
					<p>' . $message . '</p>
					<hr />
					<address>' . $signature . '</address>
				</body>
				</html>';
	 
			echo $body;
		}
		Yii::app()->end();
	}
	
	private function _getStatusCodeMessage($status)
	{
		$codes = Array(
			200 => 'OK',
			400 => 'Bad Request',
			401 => 'Unauthorized',
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
		);
		return (isset($codes[$status])) ? $codes[$status] : '';
	}
}