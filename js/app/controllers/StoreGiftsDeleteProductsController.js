app.controller('StoreGiftsDeleteProductsController', 
			   ['$scope', '$rootScope', 'Products', '$routeParams', '$location',
			   function ($scope, $rootScope, Products, $routeParams, $location) {

	$scope.update = function() {
		Products.update($scope.gifts);
		$scope.saving = true;
		$scope.showErrors = false;
	}
	
	
	
}]);