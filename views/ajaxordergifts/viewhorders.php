<div style="margin: 0 20px 20px 0;" class="row" ng-controller="StoreGiftsHordersController">
	<div class="col-md-12" ng-repeat="view in vieworder">
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
					<div class="col-md-8">{{view.status[0].name}}</div>
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
					<div class="col-md-8">{{view.created_at}}</div>
				</div><bR>
				<div class="row">
					<div class="col-md-4"><?=Yii::t('app','Дата исполнения заказа')?></div>
					<div class="col-md-8">{{view.closed_at}}</div>
				</div><bR>
				<div class="row">
					<div class="col-md-4"><?=Yii::t('app','Дата отклонения')?></div>
					<div class="col-md-8">{{view.declined_at}}</div>
				</div><bR>
				<div class="row">
					<div class="col-md-4"><?=Yii::t('app','Комментарий')?></div>
					<div class="col-md-8">{{view.commentary}}</div>
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
		<div class="row">
		<div class="col-md-4">
			<a href="/admin/storegifts#/horders/update/id/{{view.id}}" title="<?=Yii::t('app', 'Редактировать')?>" class="btn btn-primary"><?=Yii::t('app', 'Редактировать')?></a>
			<a href="/admin/storegifts#/horders" class="btn"><?=Yii::t('app','назад')?></a>
		</div>
	</div>
	</div>
	
</div>
<br><br>