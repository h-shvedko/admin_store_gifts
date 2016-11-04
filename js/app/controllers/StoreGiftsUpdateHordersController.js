app.controller('StoreGiftsUpdateHordersController', 
			   ['$scope', '$rootScope', 'Horders', '$routeParams', '$location', '$window','$anchorScroll','$http',
			   function ($scope, $rootScope, Horders, $routeParams, $location, $window, $anchorScroll, $http) {

    $scope.gifts = {};
	$scope.horders = [];
    $scope.saving = false;
	$scope.isNew = false;
	$scope.showErrors = false;
    $scope.errors = [];
	$scope.statuses = [];
	$scope.success = false;
	
	$scope.update = function() {
		Horders.update($scope.horders);
		$scope.saving = true;
		$scope.showErrors = false;
		$scope.success = false;
	}
	
	Horders.view($routeParams);
	Horders.status();
	
	$rootScope.$on('horder:updated', function(event, data) {
		$scope.saving = false;
		$scope.success = true;
		
		var statusCurrent = [];
		
		angular.forEach($scope.statuses, function(value, key){
			if(parseInt(value.id) === parseInt($scope.horders[0].status))
			{
				statusCurrent.push(value);
				return;
			}
		});
		
		var now = new Date();
				
		if(statusCurrent[0].name === "Отклоненный")
		{
			$scope.horders[0].closed_at = '';
			$scope.horders[0].declined_at = Date.parse(now);
		}
		else if(statusCurrent[0].name === "Выполненный")
		{
			$scope.horders[0].closed_at = Date.parse(now);
			$scope.horders[0].declined_at = '';
		}
		else
		{
			$scope.horders[0].closed_at = '';
			$scope.horders[0].declined_at = '';
		}
	});
	
	$rootScope.$on('horder:viewed', function(event, data) {
		$scope.horders = Horders.viewData();
		$scope.success = false;
	});
	
	$rootScope.$on('status:viewed', function(event, data) {
		$scope.statuses = Horders.viewStatus();
		$scope.success = false;
	});
	
	$rootScope.$on('horder:error', function(event, data) {
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