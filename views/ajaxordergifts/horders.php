<style>
.actions
{
	width: 15%;
}
.actions a
{
	margin: 0 30px 0 30px;
	text-align: center;
}
.actions a:hover
{
	opacity: 0.5;
}
.input-group-btn
{
//	  position: relative;
//  right: 35px;
//  z-index: 100;
}
.form-control
{
	border-radius: 5px !important;
	padding: 1px !important;
}
</style>
<div ng-controller="StoreGiftsHordersController">
	<h3><?=Yii::t('app','Список заказов')?></h3>
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
				<th style="width: 3%;">ID</th>
				<th style="width: 10%;"><?=Yii::t('app','номер')?></th>
				<th style="width: 10%;"><?=Yii::t('app','пользователь')?></th>
				<th style="width: 15%;"><?=Yii::t('app','ФИО')?></th>
				<th style="width: 10%;"><?=Yii::t('app','сумма')?></th>
				<th style="width: 18%;"><?=Yii::t('app','статус')?></th>
				<th style="width: 17%;"><?=Yii::t('app','дата создания')?></th>
				<th style="width: 5%;"><?=Yii::t('app','действия')?></th>
			</tr>
			<tr class="text-uppercase">
				<th><p class="input-group"></p></th>
				<th><p class="input-group"><input class="form-control" ng-model="search.num"/></p></th>
				<th><p class="input-group"><input class="form-control" ng-model="search.username"/></p></th>
				<th><p class="input-group"><input class="form-control" ng-model="search.FIO"/></p></th>
				<th><p class="input-group"><input class="form-control" ng-model="search.total_price"/></p></th>
				<th><p class="input-group">
					<select class="form-control" ng-model="search.status.name">
						<option value="">Все</option>
						<option ng-repeat="status in statuses">{{status.name}}</option>
					</select></p>
				</th>
				<th>
				<p class="input-group">
				<input type="text" class="form-control" readonly  datepicker-popup="dd.MM.yyyy" ng-model="start" is-open="opened" min-date="minDate" max-date="'2050-06-22'" datepicker-options="dateOptions" date-disabled="disabled(date, mode)" ng-required="true" close-text="Х" placeholder="<?=Yii::t('app', 'От')?>" />
				<span class="input-group-btn">
					<button ng-click="open($event)" class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
				  </span>
				 </p>
				 <p class="input-group">
				<input type="text" class="form-control" readonly datepicker-popup="dd.MM.yyyy" ng-model="end" is-open="openedNext" min-date="minDate" max-date="'2050-06-22'" datepicker-options="dateOptions" date-disabled="disabled(date, mode)" ng-required="true" close-text="Х" placeholder="<?=Yii::t('app', 'До')?>" />
				<span class="input-group-btn">
					<button ng-click="openNext($event)" class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
				  </span>
				 </p>
				</th>
				
				<th> <p class="input-group"><button ng-click="reset()" class="btn btn-default" type="button">Сбросить фильтр</button></p></th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="horder in (filteredPots = (searchedPots = (horders | filter:search:strict | created:start:end) | pagination:watchPage:maxSizes))">
				<td>{{horder.id}}</td>
				<td>{{horder.num}}</td>
				<td>{{horder.username}}</td>
				<td>{{horder.FIO}}</td>
				<td>{{horder.total_price}}</td>
				<td>{{horder.status[0].name}}</td>
				<td>{{horder.created_at | date:'dd.MM.yyyy'}}</td>
				<td class="actions">
					<a href="#/horders/view/id/{{horder.id}}" title="<?=Yii::t('app', 'Просмотр')?>"><i class="fa fa-eye fa-2x"></i></a>
					<a href="#/horders/update/id/{{horder.id}}" title="<?=Yii::t('app', 'Редактировать')?>"><i class="fa fa-pencil fa-2x"></i></a>
				</td>
			</tr>
		</tbody>
		
	</table>
	<pagination boundary-links="true" total-items="searchedPots.length" items-per-page="maxSize" ng-model="currentPage" class="pagination-sm" previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></pagination>
</div>
<br><br><bR><bR><bR><br><br><br><bR><bR><bR><br>