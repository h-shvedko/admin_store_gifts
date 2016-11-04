<style>
.content_content
{
	height: 1000px;
}
.box
{
	display: inline-block;
	border: 1px solid;
	border-color: grey;
	margin: 0 50px 0 50px;
	padding: 75px;
	text-align: center;
	font-size: 16px;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	border-radius: 2px;
}
.box:hover
{
	box-shadow:0 0 15px #000000;
	border:1px solid #000000;
	cursor: pointer;
}
.box:active
{
	box-shadow:0 0 5px #000000;
	border:1px solid #000000;
	cursor: pointer;
}



</style>
<div ng-controller="StoreGiftsIndexController">
	<a href="#/products" ><div ng-show="isProducts" class="box"><i class="fa fa-archive fa-4x"></i><br><br><?=Yii::t('app','Просмотр подарков')?></div></a>
	<a href="#/horders"><div ng-show="isHorders" class="box"><i class="fa fa-rub fa-4x"></i><br><br><?=Yii::t('app','Список заказов')?></div></a>
	
	<br><br>
	
	
</div>

