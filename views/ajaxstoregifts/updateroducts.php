<style>
.hidescreen {
     position: absolute;
	 z-index: 9998; 
	 width: 100%;
	 height: 900px;
	 background: #ffffff;
	 opacity: 0.7;
	 filter: alpha(opacity=70);
	 left:0;
	 top:0;
}
.load_page {
	 z-index: 9999;
	 position: absolute;
	 left: 50%;
	 top: 50%;
	 background: #ffffff;
	 border-radius: 3px;
	 width: auto;
}
li.ng-isolate-scope
{
 font-size: 16px;
}
.form-control.ng-dirty.ng-invalid
{
	background: #F490AB;
}
</style>
<div id="scrollArea" ng-controller="StoreGiftsUpdateProductsController" nv-file-drop="" uploader="uploader" filters="queueLimit, customFilter"> 
<tabset justified="true">
    <tab heading="Карточка товара" id="top">
<div class="hidescreen" ng-show="saving"></div>
<span class="load_page" ng-show="saving"><i class="fa fa-spinner fa-spin fa-5x"></i></span>
<p class="bg-warning" style="padding: 15px;" ng-hide="success"><b><?=Yii::t('app','Поля помеченные *, обязательны для заполнения')?></b></p>
<p class="bg-success" style="padding: 15px;" ng-show="success"><b><?=Yii::t('app','Подарок успешно изменен')?></b></p>
<p class="bg-danger" style="padding: 15px;" ng-show="showErrors"><b><?=Yii::t('app','Произошла ошибка')?></b></p>

<form name="placeForm" novalidate class="form-horizontal" ng-repeat="gift in gifts">
    <h3 ng-show="isNew"><?=Yii::t('app', 'Создание подарка')?></h3>
	<h3 ng-hide="isNew"><?=Yii::t('app', 'Редактирование подарка')?></h3>
	<hr>
			<div class="form-group">
				<label class="col-sm-2 control-label"><?=Yii::t('app','Название')?><i class="glyphicon glyphicon-asterisk"></i></label >
				<div class="col-sm-10">
					<input type="text" class="form-control" ng-model="gift.name" name="name" required  placeholder="<?=Yii::t('app', 'Введите название подарка')?>">
					<span class="text-danger" ng-show="placeForm.$dirty && placeForm.name.$error.required"><?=Yii::t('app', 'Это поле обязательно для заполнения')?></span>
				</div>
			</div><bR>
			<div class="form-group">
				<label class="col-sm-2 control-label"><?=Yii::t('app','Артикул')?><i class="glyphicon glyphicon-asterisk"></i></label >
				<div class="col-sm-10">
					<input type="text" class="form-control" ng-model="gift.article" name="article" required  placeholder="<?=Yii::t('app', 'Введите артикул')?>">
					<span class="text-danger" ng-show="placeForm.$dirty && placeForm.article.$error.required"><?=Yii::t('app', 'Это поле обязательно для заполнения')?></span>
				</div>
			</div><bR>
			<div class="form-group">
				<label class="col-sm-2 control-label"><?=Yii::t('app','Статус')?><i class="glyphicon glyphicon-asterisk"></i></label >
				<div class="col-sm-10">
					<select class="form-control" ng-model="gift.status" name="status" required>
						<option value="0" ng-selected="gift.status.name=='Не активный'">Не активный</option>
						<option value="1" ng-selected="gift.status.name!='Не активный' && gift.status.name!='Удаленный'">Активный  </option>
						<option value="2" ng-selected="gift.status.name=='Удаленный'">Удаленный</option>
					</select>
					<span class="text-danger" ng-show="placeForm.$dirty && placeForm.status.$error.required"><?=Yii::t('app', 'Это поле обязательно для заполнения')?></span>
				</div>
			</div><bR>
			<div class="form-group">
				<label class="col-sm-2 control-label"><?=Yii::t('app','Валюта')?><i class="glyphicon glyphicon-asterisk"></i></label >
				<div class="col-sm-10">
					<input type="text" class="form-control" value="<?=Yii::t('app','Дарики')?>" disabled="disabled">
				</div>
			</div><bR>
			<div class="form-group">
				<label class="col-sm-2 control-label"><?=Yii::t('app','Цена')?><i class="glyphicon glyphicon-asterisk"></i></label >
				<div class="col-sm-10">
					<input type="text" class="form-control" ng-model="gift.price" name="price" pattern="\-?\d+(\.\d{0,})? " required placeholder="<?=Yii::t('app', 'Введите цену подарка')?>">
					<span class="text-danger" ng-show="placeForm.$dirty && placeForm.price.$error.required"><?=Yii::t('app', 'Это поле обязательно для заполнения')?></span>
					<span class="text-danger" ng-show="placeForm.$dirty && placeForm.price.$error.pattern"><?=Yii::t('app', 'В поле цены допускаются только цифры')?></span>
				</div>
			</div><bR>
			<div class="form-group">
				<label class="col-sm-2 control-label"><?=Yii::t('app','Описание (для поисковых систем)')?></label >
				<div class="col-sm-10">
					<textarea  rows="2" type="text" class="form-control" ng-model="gift.metadescr" name="metadescription" placeholder="<?=Yii::t('app', 'Введите описание (для поисковых систем)')?>"></textarea>					
				</div>
			</div><bR>
			<div class="form-group">
				<label class="col-sm-2 control-label"><?=Yii::t('app','Ключевые слова (для поисковых систем)')?></label >
				<div class="col-sm-10">
					<textarea  rows="2" type="text" class="form-control" ng-model="gift.metakeywords" name="metakeywords" placeholder="<?=Yii::t('app', 'Введите ключевые слова (для поисковых систем)')?>"></textarea>	
				</div>
			</div><bR>
			<div class="form-group">
				<label class="col-sm-2 control-label"><?=Yii::t('app','Описание для заказа')?><i class="glyphicon glyphicon-asterisk"></i></label >
				<div class="col-sm-10">
					<textarea  rows="2" type="text" class="form-control" ng-model="gift.orderdescr" name="orderdescr" required  placeholder="<?=Yii::t('app', 'Введите описание для заказа')?>"></textarea>
					<span class="text-danger" ng-show="placeForm.$dirty && placeForm.orderdescr.$error.required"><?=Yii::t('app', 'Это поле обязательно для заполнения')?></span>
				</div>
			</div><bR>
			<div class="form-group">
				<label class="col-sm-2 control-label"><?=Yii::t('app','Описание')?><i class="glyphicon glyphicon-asterisk"></i></label >
				<div class="col-sm-10">
					<textarea  rows="10" type="text" class="form-control ckfinder-replacing" ng-model="gift.description" name="description" required  placeholder="<?=Yii::t('app', 'Введите Описание')?>"></textarea>
					<span class="text-danger" ng-show="placeForm.$dirty && placeForm.description.$error.required"><?=Yii::t('app', 'Это поле обязательно для заполнения')?></span>
				</div>
			</div><bR>

			
   <button type="submit" ng-disabled="placeForm.$invalid || saving" ng-click="update()" class="btn btn-primary" style="margin-top: 20px;">
        <span ng-show="isNew"><?=Yii::t('app', 'Создать')?></span>
		<span ng-hide="isNew"><?=Yii::t('app', 'Сохранить')?></span>
    </button>
 
    <a href="/admin/storegifts#/products" class="btn"><?=Yii::t('app', 'Отмена')?></a>
</form>
</tab>
    <tab ng-hide="isNew" heading="Изображения">
		<div class="form-group" style="margin-left: 25px;">
			<? include('uploader.php');?>
		</div>
	</tab>
</tabset>
</div>
<br>