app.controller('StoreGiftsUpdateProductsController', 
			   ['$scope', '$rootScope', 'Products', '$routeParams', '$location', 'FileUploader', '$window','$anchorScroll','$http',
			   function ($scope, $rootScope, Products, $routeParams, $location, FileUploader, $window, $anchorScroll, $http) {

    $scope.gifts = {};
	$scope.product = [];
    $scope.saving = false;
	$scope.isNew = false;
	$scope.isAdd = false;
    $scope.showErrors = false;
    $scope.errors = [];
	$scope.statuses = [];
	
	Products.status();
	
	$rootScope.$on('status:viewed', function() {
		$scope.statuses = Products.viewStatus();
	});
//------------------------FileUploader	----------------------------------------------
	var ArrayImages = [];
	
	var uploader = $scope.uploader = new FileUploader({
            url: '/admin/storegifts/Ajaxstoregifts/uploadFiles'
        });
		
	uploader.formData.push({
			name: 'id',
			value: $routeParams.id
		});

        // FILTERS

	uploader.filters.push({
		name: 'imageFilter',
		fn: function(item /*{File|FileLikeObject}*/, options) {
			var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
			return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
		}
	});
	
	$scope.remove = function(value) {
		var id = {};
	
		angular.forEach(ArrayImages, function(values, key){
			if(value.file.name === values.file && value.file.size === values.size && value.$$hashKey === values.hashKey)
			{
				id = values.id;
				$http.post('/admin/storegifts/Ajaxstoregifts/DeleteAttachmentsProducts/', {data: values.id, YII_CSRF_TOKEN : app.csrfToken})
				.success(function(data, status, headers, config) {
					uploader.removeFromQueue(value);
					$rootScope.$broadcast('picture:deleted', data);
				});
				
			}
		});
		
		angular.forEach($scope.gifts[0].images, function(image, key){

			if(id === image.id)
			{
				$scope.gifts[0].images.splice(key,1);
			}
		});
	}
	
	$scope.removeImg = function(value) {

		angular.forEach($scope.gifts[0].images, function(values, key){
			if(value.id === values.id)
			{
				$http.post('/admin/storegifts/Ajaxstoregifts/DeleteAttachmentsProducts/', {data: values.id, YII_CSRF_TOKEN : app.csrfToken})
				.success(function(data, status, headers, config) {
					$scope.gifts[0].images.splice(key,1);
					$rootScope.$broadcast('picture:deleted', data);
				});
				
			}
		});
	}
	
	uploader.onSuccessItem = function(fileItem, response, status, headers) {
		ArrayImages.push({
			'file': fileItem.file.name,
			'size': fileItem.file.size,
			'id': response.data.id,
			'hashKey': fileItem.$$hashKey,
		});
		
		var start = response.data.full_path.indexOf('/upload');
		var url = response.data.full_path.slice(start);
		$scope.gifts[0].images.push({
				'id': response.data.id,
				'title': fileItem.file.name,
				'url': url,
		});
		fileItem.url = url;
		
	};
	
	$scope.main = function(value) {
		
		angular.forEach(ArrayImages, function(values, key){
			if(value.file.name === values.file && value.file.size === values.size && value.$$hashKey === values.hashKey)
			{
				$http.post('/admin/storegifts/Ajaxstoregifts/UpdateMainProducts/', {picture: values.id, id: value.formData[0].value, YII_CSRF_TOKEN : app.csrfToken})
				.success(function(data, status, headers, config) {
					value.main = true;
					$scope.gifts[0].main_img = value.url;
					$rootScope.$broadcast('main:updated', data);
				});
			}
		});
		angular.forEach(uploader.queue, function(item, key){
			if(item.$$hashKey !== value.hashKey)
			{
				item.main = false;
			}
		});
	}
	
	$scope.mainImg = function(value) {
		
		angular.forEach(uploader.queue, function(item, key){
			if(item.$$hashKey !== value.hashKey)
			{
				item.main = false;
			}
		});
		
		angular.forEach($scope.gifts, function(item, key){
			if(item.$$hashKey !== value.hashKey)
			{
				item.main = false;
			}
		});
		value.product = $routeParams.id;
		
		angular.forEach($scope.gifts[0].images, function(values, key){
			if(value.id === values.id)
			{
				$http.post('/admin/storegifts/Ajaxstoregifts/UpdateMainProducts/', {picture: values.id, id: value.product, YII_CSRF_TOKEN : app.csrfToken})
				.success(function(data, status, headers, config) {
					value.main = true;
					$scope.gifts[0].main_img = value.url;
					$rootScope.$broadcast('main:updated', data);
				});
				
			}
		});
	}
//----------------------------------------------------------------------
	$scope.update = function() {
		$scope.gifts.scenario = 'update';
		Products.update($scope.gifts);
		$scope.saving = true;
		$scope.showErrors = false;
		$scope.success = false;
	}
	
	Products.view($routeParams);
	
	$rootScope.$on('product:updated', function(event, data) {
		$scope.saving = false;
		$scope.success = true;
	});
	
	$rootScope.$on('product:viewed', function(event, data) {
		$scope.gifts = Products.viewData();
		$scope.gifts.id = $routeParams.id;
		$scope.success = false;
	});
	
	$rootScope.$on('product:error', function(event, data) {
		$scope.showErrors = true;
		$scope.errors = [];
		angular.forEach(data, function(error) {
			if (typeof error == 'object') {
				angular.forEach(error, function(err) {
					$scope.errors.push(err);
				});
			}
			else {
				$scope.errors.push(error);
			}
		});
		$scope.saving = false;
	});
	
}]);