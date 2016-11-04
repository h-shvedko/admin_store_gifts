<?php

class AjaxordergiftsController extends AjaxordergiftsControllerBase
{

	public function actionIndex()
    {
		$this->index();
    }	
	
	public function actionHorders()
    {
		$this->horders();
    }	
	
	public function actionviewHorders()
    {
		$this->viewHorders();
    }	
	
	public function actioncreateHorders()
    {
		$this->createHorders();
    }	

	public function actionupdateHorders()
    {
		$this->updateHorders();
    }	
	
	public function actionGetStatuses()
    {
		$this->GetStatuses();
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
	
	
	public function actionCreateGiftsHorders()
    {
		$this->CreateGiftsHorders();
    }	
	
	public function actionUpdateGiftsHorders()
    {
		$this->UpdateGiftsHorders();
    }
	
	public function actionViewGiftsHorders()
    {
		$this->ViewGiftsHorders();
    }	
	
	public function actionGetPay()
    {
		$this->GetPay();
    }	
	
	
	
}