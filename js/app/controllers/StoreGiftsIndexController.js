app.controller('StoreGiftsIndexController', 
			   ['$scope', '$rootScope', 'Products', '$location', 
			   function ($scope, $rootScope, Products, $location) {
$scope.isProducts = true;
$scope.isHorders = true;

$scope.sliderproducts = Products.getFirst();

$rootScope.$on('first:updated', function() {
	if($scope.sliderproducts.length ===0)
	{
		$scope.sliderproducts = Products.getFirst();
	}
});
	
}]);