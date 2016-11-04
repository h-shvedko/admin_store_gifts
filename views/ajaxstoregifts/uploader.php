 <style>
	.my-drop-zone { border: dotted 3px lightgray; }
	.nv-file-over { border: dotted 3px red; } /* Default class applied to drop zones on over */
	.another-file-over-class { border: dotted 3px green; }
	html, body { height: 100%; }
	.col-md-3>img, .col-md-6>img
	{
		width: 100%;
		margin-bottom: 5px;
	}
	
	.col-md-9>img
	{
		width: 50%;
		margin-bottom: 5px;
	}
	.col-md-3
	{
		margin-bottom: 20px;
	}
</style>
<br><bR>
<div class="row">

	<div class="col-md-3">

		<h3>Выбор файлов</h3>

		<div ng-show="uploader.isHTML5">
			<!-- 3. nv-file-over uploader="link" over-class="className" -->
			<div class="well my-drop-zone" nv-file-over="" uploader="uploader">
				Перетащите сюда файл
			</div>
		</div>

		<!-- Example: nv-file-select="" uploader="{Object}" options="{Object}" filters="{String}" -->
		
		Выберите файл
		<input type="file" nv-file-select="" uploader="uploader" />
	</div>

	<div class="col-md-9" style="margin-bottom: 40px">
	
		<h3>Список загружаемых файлов</h3>
		<p>Количество файлов: {{ uploader.queue.length }}</p>

		<table class="table">
			<thead>
				<tr>
					<th width="50%">Имя</th>
					<th>Главное изображение</th>
					<th ng-show="uploader.isHTML5">Размер</th>
					<th ng-show="uploader.isHTML5">Прогресс</th>
					<th>Статус</th>
					<th>Действия</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="item in uploader.queue">
					<td><strong>{{ item.file.name }}</strong>
						<div ng-show="uploader.isHTML5" ng-thumb="{ file: item._file, height: 100 }"></div>
					</td>
					<td><span ng-show="item.main"><i class="fa fa-check"></i></span></td>
					<td ng-show="uploader.isHTML5" nowrap>{{ item.file.size/1024/1024|number:2 }} MB</td>
					<td ng-show="uploader.isHTML5">
						<div class="progress" style="margin-bottom: 0;">
							<div class="progress-bar" role="progressbar" ng-style="{ 'width': item.progress + '%' }"></div>
						</div>
					</td>
					<td class="text-center">
						<span ng-show="item.isSuccess"><i class="fa fa-check"></i></span>
						<span ng-show="item.isCancel"><i class="fa fa-circle-o-notch"></i></span>
						<span ng-show="item.isError"><i class="fa fa-times"></i></span>
					</td>
					<td nowrap>
						<button type="button" class="btn btn-success btn-xs" ng-click="item.upload()" ng-disabled="item.isReady || item.isUploading || item.isSuccess">
							<i class="fa fa-upload"></i> Загрузить
						</button>
						<button type="button" class="btn btn-warning btn-xs" ng-click="item.cancel()" ng-disabled="!item.isUploading">
							<i class="fa fa-ban"></i> Отменить
						</button>
						<button type="button" class="btn btn-danger btn-xs" ng-click="remove(item)">
							<i class="fa fa-trash-o"></i> Удалить
						</button>
						<button type="button" class="btn btn-success btn-xs" ng-click="main(item)" ng-disabled="!item.isSuccess">
							<i class="fa fa-star"></i> Главное
						</button>
					</td>
				</tr>
			</tbody>
		</table>

		<div>
			<div>
				Прогресс загрузки всех файлов:
				<div class="progress" style="">
					<div class="progress-bar" role="progressbar" ng-style="{ 'width': uploader.progress + '%' }"></div>
				</div>
			</div>
			
		</div>
		<hr>
		<div class="row" ng-hide="isAdd">
			<div class="col-md-9 col-md-offset-3">
				<h3>Главное изображения подарка</h3>
				<img ng-src="{{gifts[0].main_img}}" alt="нет изображения"/><br>
				<hr><br>
			</div>
		<h3>Изображения подарка</h3>
		<div ng-repeat="image in gifts[0].images" class="col-md-3">
			<img ng-src="{{image.url}}" alt="нет изображения"/><br>
			<button type="button" class="btn btn-danger btn-xs" ng-click="removeImg(image)">
				<i class="fa fa-trash-o"></i> Удалить
			</button>
			<button type="button" class="btn btn-success btn-xs" ng-click="mainImg(image)">
				<i class="fa fa-star"></i> Главное
			</button>
		</div>
	</div>

	</div>

</div>