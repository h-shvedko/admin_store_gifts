<style>
.actions
{
	width: 15%;
}
.actions a
{
	margin: 0 10px 0 10px;
	text-align: center;
}
.actions a:hover
{
	opacity: 0.5;
}
</style>
<div ng-controller="StoreGiftsProductsController">
	<h3><?=Yii::t('app','Список подарков')?></h3>
	<div>
		<a href="#/products/create" title="<?=Yii::t('app', 'Создать подарок')?>" style="font-size: 14px;"><?=Yii::t('app', 'Создать подарок')?></a>
	</div><bR>
	<hr>
	<div>
		<h5>Отображать на странице</h5>
		<div style="display: inline-block;">
			<a style="margin-right: 10px;" href ng-click="changesize(25)">25</a>
			<a style="margin-right: 10px;" href ng-click="changesize(50)">50</a>
			<a style="margin-right: 10px;" href ng-click="changesize(100)">100</a>
		</div>
	</div>
	<hr>
	<table class="table table-hover">
		<thead>
			<tr class="text-uppercase">
				<th>ID</th>
				<th><?=Yii::t('app','название')?></th>
				<th><?=Yii::t('app','валюта')?></th>
				<th><?=Yii::t('app','цена')?></th>
				<th><?=Yii::t('app','статус')?></th>
				<th><?=Yii::t('app','действия')?></th>
			</tr>
			<tr class="text-uppercase">
				<th><?=Yii::t('app','фильтр')?></th>
				<th><input class="form-control" ng-model="search.name"/></th>
				<th><input class="form-control" ng-model="search.currency"/></th>
				<th><input class="form-control" ng-model="search.price"/></th>
				<th>
					<select class="form-control" ng-model="search.status.name">
						<option value="">Все</option>
						<option ng-repeat="status in statuses">{{status.name}}</option>
					</select>
				</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="product in (filteredPots = (searchedPots = (products | filter:search:strict)| pagination:watchPage:maxSizes ))">
				<td>{{product.id}}</td>
				<td>{{product.name}}</td>
				<td>{{product.currency}}</td>
				<td>{{product.price}}</td>
				<td>{{product.status.name}}</td>
				<td class="actions">
					<a href="#/products/view/id/{{product.id}}" title="<?=Yii::t('app', 'Просмотр')?>"><i class="fa fa-eye fa-2x"></i></a>
					<a href="#/products/update/id/{{product.id}}" title="<?=Yii::t('app', 'Редактировать')?>"><i class="fa fa-pencil fa-2x"></i></a>
					<a href="#/products" ng-click="del(product)" title="<?=Yii::t('app', 'Удалить')?>"><i class="fa fa-trash fa-2x"></i></a>
				</td>
			</tr>
		</tbody>
		
	</table>
	<pagination boundary-links="true" total-items="searchedPots.length" items-per-page="maxSize" ng-model="currentPage" class="pagination-sm" previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></pagination>
</div>