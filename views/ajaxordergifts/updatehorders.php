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
<div style="margin: 0 20px 20px 0;" class="row" ng-controller="StoreGiftsUpdateHordersController">
<div class="hidescreen" ng-show="saving"></div>
<span class="load_page" ng-show="saving"><i class="fa fa-spinner fa-spin fa-5x"></i></span>
<p class="bg-success" style="padding: 15px;" ng-show="success"><b><?=Yii::t('app','Заказ успешно изменен')?></b></p>
<p class="bg-danger" style="padding: 15px;" ng-show="showErrors"><b><?=Yii::t('app','Произошла ошибка')?></b><br>
	<span ng-repeat="error in errors">
		{{error}}
	</span><br></b>
</p>

<form name="placeForm" novalidate class="form-horizontal">
	<div class="col-md-12" ng-repeat="view in horders">
		<div class="row">
		
			<div class="col-md-12">
				<h4><?=Yii::t('app','Описание заказа')?></h4><br>
				<div class="row">
					<div class="col-md-4">ID</div>
					<div class="col-md-8">{{view.id}}</div>
				</div><bR>
				<div class="row">
					<div class="col-md-4"><?=Yii::t('app','Номер заказа')?></div>
					<div class="col-md-8">{{view.num}}</div>
				</div><bR>
				<div class="row">
					<div class="col-md-4"><?=Yii::t('app','Статус')?></div>
					<div class="col-md-8">
						 <select ng-model="view.status[0]" class="form-control" style="width: 200px !important;" required="required">
						 <option ng-repeat="status in statuses" ng-selected="status.id == view.status[0].id" value="{{status.id}}">{{status.name}}</option>
						 </select>
					</div>
				</div><bR>
				<div class="row">
					<div class="col-md-4"><?=Yii::t('app','Телефон пользователя')?></div>
					<div class="col-md-8">{{view.username}}</div>
				</div><bR>
				<div class="row">
					<div class="col-md-4"><?=Yii::t('app','Общая стоимость заказа')?></div>
					<div class="col-md-8">{{view.total_price}}</div>
				</div><bR>
				<div class="row">
					<div class="col-md-4"><?=Yii::t('app','Дата создания заказа')?></div>
					<div class="col-md-8">{{view.created_at | date: 'dd.MM.yyyy'}}</div>
				</div><bR>
				<div class="row">
					<div class="col-md-4"><?=Yii::t('app','Дата исполнения заказа')?></div>
					<div class="col-md-8">{{view.closed_at | date: 'dd.MM.yyyy'}}</div>
				</div><bR>
				<div class="row">
					<div class="col-md-4"><?=Yii::t('app','Дата отклонения')?></div>
					<div class="col-md-8">{{view.declined_at | date: 'dd.MM.yyyy'}}</div>
				</div><bR>
				<div class="row">
					<div class="col-md-4"><?=Yii::t('app','Комментарий')?></div>
					<div class="col-md-8"><textarea class="form-control" ng-model="view.commentary"></textarea></div>
				</div><bR>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<h4><?=Yii::t('app','Продукты заказа')?></h4><br>
						<table class="table table-hover">
							<thead>
								<tr>
									<th>ID</th>
									<th><?=Yii::t('app','Цена')?></th>
									<th><?=Yii::t('app','Количество')?></th>
									<th><?=Yii::t('app','Стоимотсть')?></th>
									<th><?=Yii::t('app','Название')?></th>
									<th><?=Yii::t('app','Артикул')?></th>
									<th><?=Yii::t('app','Описание для заказа')?></th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="order in view.orders">
									<td>{{order.id}}</td>
									<td>{{order.price}}</td>
									<td>{{order.count}}</td>
									<td>{{order.total_price}}</td>
									<td>{{order.product_name}}</td>
									<td>{{order.product_article}}</td>
									<td>{{order.product_descr}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
			<button type="submit" ng-disabled="placeForm.$invalid || saving" ng-click="update()" class="btn btn-primary">
				<span><?=Yii::t('app', 'Сохранить')?></span>
			</button>
		
			<a href="/admin/storegifts#/horders" class="btn"><?=Yii::t('app','назад')?></a>
		</div>
	</div>
</form>
</div>
<br><br>