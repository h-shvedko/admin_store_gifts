<style>
.col-md-12 img, .col-md-3 img
{
	width: 100%;
}

.col-md-3
{
	margin-bottom: 10px;
	

}

.col-md-3 img:hover
{
	 box-shadow: 0 0 10px rgba(0,0,0,0.5);
	cursor:pointer;
}

</style>
<div style="margin: 0 20px 20px 0;" class="row" ng-controller="StoreGiftsProductsController">
	<div class="col-md-10" ng-repeat="view in viewproduct">
		<div class="row">
			<div class="col-md-6">
			<h4><?=Yii::t('app','описание продукта')?></h4><br>
				<div class="row">
					<div class="col-md-4">ID</div>
					<div class="col-md-8">{{view.id}}</div>
				</div><bR>
				<div class="row">
					<div class="col-md-4"><?=Yii::t('app','название')?></div>
					<div class="col-md-8">{{view.name}}</div>
				</div><bR>
				<div class="row">
					<div class="col-md-4"><?=Yii::t('app','артикул')?></div>
					<div class="col-md-8">{{view.article}}</div>
				</div><bR>
				<div class="row">
					<div class="col-md-4"><?=Yii::t('app','валюта (Дарики)')?></div>
					<div class="col-md-8">{{view.currency}}</div>
				</div><bR>
				<div class="row">
					<div class="col-md-4"><?=Yii::t('app','статус')?></div>
					<div class="col-md-8">{{view.status.name}}</div>
				</div><bR>
				<div class="row">
					<div class="col-md-4"><?=Yii::t('app','Дарики-цена')?></div>
					<div class="col-md-8">{{view.price}}</div>
				</div><bR>
				<div class="row">
					<div class="col-md-4"><?=Yii::t('app','описание (для поисковых систем)')?></div>
					<div class="col-md-8">{{view.metadescr}}</div>
				</div><bR>
				<div class="row">
					<div class="col-md-4"><?=Yii::t('app','ключевые слова (для поисковых систем)')?></div>
					<div class="col-md-8">{{view.metakeywords}}</div>
				</div><bR>
				<div class="row">
					<div class="col-md-4"><?=Yii::t('app','описание для заказа')?></div>
					<div class="col-md-8">{{view.orderdescr}}</div>
				</div><bR>
				<div class="row">
					<div class="col-md-4"><?=Yii::t('app','полное описание продукта')?></div>
					<div class="col-md-8">{{view.description}}</div>
				</div><bR>
			</div>
			<div class="col-md-6">
				<h3><?=Yii::t('app','изображения продукта')?></h3><br>
				<div class="row">
					<div class="col-md-12">
						<h4><?=Yii::t('app','главное изображение продукта')?></h4>
						<img ng-src="{{view.main_img}}" alt="Нет изображения" />
					</div>
				</div><bR>
				<div class="row">
					<div class="col-md-12">
						<h4><?=Yii::t('app','изображения продукта')?></h4>
						<div class="row" >
							<div class="col-md-3" ng-repeat="image in view.images">
								<img ng-src="{{image.url}}" alt="Нет изображения"/>
							</div>
						</div>
					</div>
				</div><bR>
			</div>
	</div>
	<div class="row">
		<div class="col-md-4"><a href="/admin/storegifts#/products" class="btn"><?=Yii::t('app','назад')?></a></div>
	</div>
</div>
<br><br>