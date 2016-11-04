app.factory('Horders', ['$http', '$rootScope', function($http, $rootScope){

	var horders = [];
	var first = [];
	
	function getHorders() {
		$http.get('/admin/storegifts/Ajaxordergifts/GetGiftsHorders')
			.success(function(data, status, headers, config) {
				horders = data;
				
				$rootScope.$broadcast('horder:geted');
			})
			.error(function(data, status, headers, config) {
				console.log(data);
			});
	}
	
	getHorders();

	var service = {};

	service.get = function() {
		return horders;
	}
	
	var newHorder = {};
	service.add = function(horder) {
		newHorder = '';
		
		$http.post('/admin/storegifts/Ajaxordergifts/CreateGiftsHorders/', {data: horder, YII_CSRF_TOKEN : app.csrfToken})
			.success(function(data, status, headers, config) {
				newHorder = data;
				getHorders();
				$rootScope.$broadcast('horder:added', data);
			})
			.error(function(data, status, headers, config) {
				$rootScope.$broadcast('horder:error', data);
			});
	}

	service.getNew = function(){
		return newHorder;
	}
	
	service.update = function(horder) {
		$http.post('/admin/storegifts/Ajaxordergifts/UpdateGiftsHorders/',{data: horder, YII_CSRF_TOKEN : app.csrfToken})
			.success(function(data, status, headers, config) {
				getHorders();
				$rootScope.$broadcast('horder:updated', data);
			})
			.error(function(data, status, headers, config) {
				$rootScope.$broadcast('horder:error', data);
			});
	}
	
	var horderData = {};
	service.view = function(horder) {
		$http.post('/admin/storegifts/Ajaxordergifts/ViewGiftsHorders',{data: horder, YII_CSRF_TOKEN : app.csrfToken})
			.success(function(data, status, headers, config) {
				horderData = data;
				$rootScope.$broadcast('horder:viewed', data);
			})
			.error(function(data, status, headers, config) {
				$rootScope.$broadcast('horder:error', data);
			});
	}
	
	service.viewData = function() {
		return horderData;
	}
	
	var statusData = {};
	service.status = function() {
		$http.get('/admin/storegifts/Ajaxordergifts/GetStatuses')
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
	
	var payData = [];
	service.pay = function() {
		$http.get('/admin/storegifts/Ajaxordergifts/GetPay')
			.success(function(data, status, headers, config) {
				payData = data;
				$rootScope.$broadcast('pay:viewed', data);
			})
			.error(function(data, status, headers, config) {
				$rootScope.$broadcast('pay:error', data);
			});
	}
	
	service.viewPay = function() {
		return payData;
	}
	
	
	return service;
	}]);