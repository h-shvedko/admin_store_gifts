<?php

class AjaxstoregiftsController extends AjaxstoregiftsControllerBase
{

	public function actionIndex()
    {
		$this->index();
    }	
	
	public function actionSlider()
    {
		$this->slider();
    }	
	
	
	public function actionGetFirst()
    {
		$this->GetFirst();
    }	
	
	public function actionProducts()
    {
		$this->products();
    }	
	
	public function actionviewProducts()
    {
		$this->viewProducts();
    }	
	
	public function actioncreateProducts()
    {
		$this->createProducts();
    }	

	public function actionupdateProducts()
    {
		$this->updateProducts();
    }	
	
    public function actionViewGiftsHorder()
    {
		$this->ViewGiftsHorder();
    }	
	
	public function actionGetGiftsHorders()
    {
		$this->GetGiftsHorders();
    
	}	
	public function actionUpdateGiftsHorder()
    {
		$this->UpdateGiftsHorder();
    }	
	
	public function actionGetGiftsProducts()
    {
		$this->GetGiftsProducts();
    }	
		
	public function actionCreateGiftsProducts()
    {
		$this->CreateGiftsProducts();
    }	
	
	public function actionUpdateGiftsProducts()
    {
		$this->UpdateGiftsProducts();
    }
	
	public function actionDeleteGiftsProducts()
    {
		$this->DeleteGiftsProducts();
    }
	
	public function actionDeleteAttachmentsProducts()
    {
		$this->DeleteAttachmentsProducts();
    }
	
	public function actionViewGiftsProducts()
    {
		$this->ViewGiftsProducts();
    }	
	
	public function actionuploadFiles()
    {
		$this->uploadFiles();
    }	
	
	public function actionUpdateMainProducts()
    {
		$this->UpdateMainProducts();
    }	
	public function actionGetStatuses()
    {
		$this->GetStatuses();
    }	

	
}