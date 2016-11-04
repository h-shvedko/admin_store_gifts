var StoreGiftsProductsController = app.controller('StoreGiftsProductsController', 
			   ['$scope', '$rootScope', 'Products', '$routeParams','$location',
			   function ($scope, $rootScope, Products, $routeParams,$location) {
			   
	$scope.isNew = true;
	$scope.products = {};
	$scope.products = Products.get();
	$scope.viewproduct = {};
	$scope.statuses = [];
	
	Products.status();
	
	$rootScope.$on('status:viewed', function() {
		$scope.statuses = Products.viewStatus();
	});
	
	if($routeParams.id !== undefined)
	{
		$scope.viewproduct = Products.view({id:$routeParams.id});
	}
	
	$rootScope.$on('product:geted', function() {
	
		if ($scope.products.length === 0) 
		{
			$scope.products = Products.get();
			$scope.totalItems = $scope.products.length;
		}
	});
	
	$rootScope.$on('product:viewed', function() {
		if ($scope.viewproduct === undefined || $scope.viewproduct.length === 0) 
		{
			$scope.viewproduct = Products.viewData();
		}
	});
	
	$scope.$watch('products', function() { 
		
		$scope.products = Products.get();
	});

	$scope.currentPage = 1;
	if($rootScope.pagesize === undefined)
	{
		$scope.maxSize = 100;
		$scope.watchPage = 0;
	}
	else
	{
		$scope.maxSize = $rootScope.pagesize;
		$scope.watchPage = $rootScope.watchPage;
	}
	
	$scope.changesize = function(val){
		$rootScope.pagesize = val;
		$rootScope.watchPage = $scope.maxSize * $scope.currentPage - $scope.maxSize;
		var path = '/products/unit/'+val;
		$location.path(path).replace();
	};
	
    $scope.$watch('currentPage', function(newPage){
			
			$scope.watchPage = newPage*$scope.maxSize - $scope.maxSize;
			$scope.maxSizes = newPage*$scope.maxSize;
	});
	
	 $scope.del = function(product){
		Products.del(product);
		
		$rootScope.$on('product:deleted', function() {
		var result = '';
		
		result = Products.getDel();

			if($.isEmptyObject(result.product))
			{
				angular.forEach($scope.products, function(prod){
					if(prod.id === product.id)
					{
						prod.status = {
							id: 2,
							name:'Удаленный'};
					}
					
				});
			}
		});
	};
	

	  
}]);