var app = angular.module('AdminStoreGifts', ['ngRoute', 'ui.bootstrap', 'ngAnimate', 'angularFileUpload']);

	app.config(['$routeProvider',function($routeProvider){
		$routeProvider.when('/',
		{
			templateUrl:'/admin/storegifts/Ajaxstoregifts/index',
			controller:'StoreGiftsIndexController'
		});
		$routeProvider.when('/products',
		{
			templateUrl:'/admin/storegifts/Ajaxstoregifts/products',
			controller:'StoreGiftsProductsController',
		});
		$routeProvider.when('/products/unit/25',
		{
			templateUrl:'/admin/storegifts/Ajaxstoregifts/products',
			controller:'StoreGiftsProductsController',
		});
		$routeProvider.when('/products/unit/50',
		{
			templateUrl:'/admin/storegifts/Ajaxstoregifts/products',
			controller:'StoreGiftsProductsController',
		});
		$routeProvider.when('/products/unit/100',
		{
			templateUrl:'/admin/storegifts/Ajaxstoregifts/products',
			controller:'StoreGiftsProductsController',
		});
		$routeProvider.when('/products/create',
		{
			templateUrl:'/admin/storegifts/Ajaxstoregifts/createProducts',
			controller:'StoreGiftsCreateProductsController'
		});
		$routeProvider.when('/products/view/id/:id',
		{
			templateUrl:'/admin/storegifts/Ajaxstoregifts/viewProducts',
			controller:'StoreGiftsProductsController'
		});
		
		$routeProvider.when('/products/update/id/:id',
		{
			templateUrl:'/admin/storegifts/Ajaxstoregifts/updateProducts',
			controller:'StoreGiftsUpdateProductsController'
		});
		
		
		//---------------------------------------------------------------------------
		$routeProvider.when('/horders',
		{
			templateUrl:'/admin/storegifts/Ajaxordergifts/horders',
			controller:'StoreGiftsHordersController'
		});
		
		$routeProvider.when('/horders/unit/25',
		{
			templateUrl:'/admin/storegifts/Ajaxordergifts/horders',
			controller:'StoreGiftsHordersController'
		});
		$routeProvider.when('/horders/unit/50',
		{
			templateUrl:'/admin/storegifts/Ajaxordergifts/horders',
			controller:'StoreGiftsHordersController'
		});
		$routeProvider.when('/horders/unit/100',
		{
			templateUrl:'/admin/storegifts/Ajaxordergifts/horders',
			controller:'StoreGiftsHordersController'
		});
		$routeProvider.when('/horders/view/id/:id',
		{
			templateUrl:'/admin/storegifts/Ajaxordergifts/viewHorders',
			controller:'StoreGiftsHordersController'
		});
		$routeProvider.when('/horders/update/id/:id',
		{
			templateUrl:'/admin/storegifts/Ajaxordergifts/updateHorders',
			controller:'StoreGiftsUpdateHordersController'
		});
		
		$routeProvider.otherwise({
			redirectTo: '/'
		});
	}]);
	
		app.filter('pagination', function() {
		  return function(arr, start, end) {
			return arr.slice(start, end);
		  };
		});
		
		app.filter('created', function() {
		  return function(arr, start, end) {
			
			
			var startDate = new Date("2000-01-01");
			var endDate = new Date("2999-01-01");	
			if(start !== undefined && start !== '')
			{
				var startDate = new Date(start);	
			}
			
			if(end !== undefined && end !== '')
			{
				var endDate = new Date(end);	
			}
			
			var result = [];
			angular.forEach(arr, function(val, key){
				value = new Date(val.created_at);
				
				if(startDate <= value && endDate >= value)
				{
					result.push(val);
				}
			});
			
			return result;
		  };
		});