app.controller('StoreGiftsCreateProductsController', 
			   ['$scope', '$rootScope', 'Products', '$routeParams', '$location', 'FileUploader', '$window','$anchorScroll','$http',
			   function ($scope, $rootScope, Products, $routeParams, $location, FileUploader, $window, $anchorScroll, $http) {

    $scope.gifts = {};
    $scope.isNew = true;
	$scope.isAdd = true;
    $scope.saving = false;
	$scope.success = false;
	$scope.newProduct = {};
	var ArrayImages = [];
	$scope.statuses = [];
	
	Products.status();
	
	$rootScope.$on('status:viewed', function() {
		$scope.statuses = Products.viewStatus();
	});
	
	$scope.attachemnts = {};
	if($scope.isNew === false)
	{
		$scope.attachemnts = Products.getAttachments();
	}

	var uploader = $scope.uploader = new FileUploader({
            url: '/admin/storegifts/Ajaxstoregifts/uploadFiles'
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
	
	
		angular.forEach(ArrayImages, function(values, key){
			if(value.file.name === values.file && value.file.size === values.size && value.$$hashKey === values.hashKey)
			{
				$http.post('/admin/storegifts/Ajaxstoregifts/DeleteAttachmentsProducts/', {data: values.id, YII_CSRF_TOKEN : app.csrfToken})
				.success(function(data, status, headers, config) {
					uploader.removeFromQueue(value);
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
	};
		
    $scope.showErrors = false;
    $scope.errors = [];

	$scope.save = function() {
		Products.add($scope.gifts);
		$scope.saving = true;
		$scope.showErrors = false;
		document.getElementById('scrollArea').scrollIntoView(true);
		
	}
	
	$scope.update = function() {
		$scope.gifts.scenario = 'add';
		Products.update($scope.gifts);
		$scope.saving = true;
		$scope.showErrors = false;
		document.getElementById('scrollArea').scrollIntoView(true);
	}
	
	$scope.main = function(value) {
		
		angular.forEach(ArrayImages, function(values, key){
			if(value.file.name === values.file && value.file.size === values.size && value.$$hashKey === values.hashKey)
			{
				$http.post('/admin/storegifts/Ajaxstoregifts/UpdateMainProducts/', {picture: values.id, id: value.formData[0].value, YII_CSRF_TOKEN : app.csrfToken})
				.success(function(data, status, headers, config) {
					value.main = true;
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
	
	if($routeParams.id !== undefined)
	{
		Products.view($routeParams);
	}
	
	$rootScope.$on('product:added', function(event, data) {
		$scope.saving = false;
		$scope.isNew = false;
		$scope.success = true;
		$scope.newProduct = {};
		$scope.newProduct = Products.getNew();
		$scope.gifts.id = $scope.newProduct.id;
		uploader.formData.push({
			name: 'id',
			value: $scope.newProduct.id
		});
	});
	
	$rootScope.$on('product:updated', function(event, data) {
		$scope.saving = false;
		$scope.isNew = false;
		$scope.success = true;
	});
	
	$rootScope.$on('product:viewed', function(event, data) {
		$scope.gifts = Products.viewData();
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