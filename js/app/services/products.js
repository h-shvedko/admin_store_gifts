app.factory('Products', ['$http', '$rootScope', function($http, $rootScope){

	var products = [];
	var first = [];
	
	function getProducts() {
		$http.get('/admin/storegifts/Ajaxstoregifts/GetGiftsProducts')
			.success(function(data, status, headers, config) {
				products = data;
				
				$rootScope.$broadcast('product:geted');
			})
			.error(function(data, status, headers, config) {
				console.log(data);
			});
	}
	
	function getFirst() {
		$http.get('/admin/storegifts/Ajaxstoregifts/GetFirst')
			.success(function(data, status, headers, config) {
				first = data;
				$rootScope.$broadcast('first:updated');
			})
			.error(function(data, status, headers, config) {
				console.log(data);
			});
	}
	getProducts();
	getFirst();
	
	var service = {};

	service.get = function() {
		return products;
	}
	
	service.getFirst = function() {
		return first;
	}

	var newProduct = {};
	service.add = function(product) {
		newProduct = '';
		
		$http.post('/admin/storegifts/Ajaxstoregifts/CreateGiftsProducts/', {data: product, YII_CSRF_TOKEN : app.csrfToken})
			.success(function(data, status, headers, config) {
				newProduct = data;
				//getProducts();
				$rootScope.$broadcast('product:added', data);
			})
			.error(function(data, status, headers, config) {
				$rootScope.$broadcast('product:error', data);
			});
	}

	service.getNew = function(){
		return newProduct;
	}
	
	service.update = function(product) {
		$http.post('/admin/storegifts/Ajaxstoregifts/UpdateGiftsProducts/',{data: product, scenario: product.scenario, YII_CSRF_TOKEN : app.csrfToken})
			.success(function(data, status, headers, config) {
				getProducts();
				$rootScope.$broadcast('product:updated', data);
			})
			.error(function(data, status, headers, config) {
				$rootScope.$broadcast('product:error', data);
			});
	}
	
	var productData = {};
	service.view = function(product) {
		$http.post('/admin/storegifts/Ajaxstoregifts/ViewGiftsProducts',{data: product, YII_CSRF_TOKEN : app.csrfToken})
			.success(function(data, status, headers, config) {
				productData = data;
				$rootScope.$broadcast('product:viewed', data);
			})
			.error(function(data, status, headers, config) {
				$rootScope.$broadcast('product:error', data);
			});
	}
	
	service.viewData = function() {
		return productData;
	}
	
	var deletingResult = {};
	
	service.del = function(product) {
		deletingResult = '';
		$http.post('/admin/storegifts/Ajaxstoregifts/DeleteGiftsProducts',{data: product.id, YII_CSRF_TOKEN : app.csrfToken})
			.success(function(data, status, headers, config) {
				deletingResult = data;
				$rootScope.$broadcast('product:deleted', data);
			})
			.error(function(data, status, headers, config) {
				$rootScope.$broadcast('product:error', data);
			});

	}
	
	service.getDel = function() {
		return deletingResult;
	}
	
	var statusData = [];
	service.status = function() {
		$http.get('/admin/storegifts/Ajaxstoregifts/GetStatuses')
			.success(function(data, status, headers, config) {
				statusData = data;
				$rootScope.$broadcast('status:viewed', data);
			})
			.error(function(data, status, headers, config) {
				$rootScope.$broadcast('status:error', data);
			});
	}
	
	service.viewStatus = function() {
		return statusData;
	}
	
	return service;
	}]);