app.controller('StoreGiftsHordersController', 
			   ['$scope', '$rootScope', 'Horders', '$routeParams','$location','$filter',
			   function ($scope, $rootScope, Horders, $routeParams, $location,$filter) {
			   
	$scope.isNew = true;
	$scope.horders = {};
	$scope.horders = Horders.get();
	$scope.vieworder = {};
	$scope.statuses = [];
	$scope.paids = [];
	$scope.newSize = {};
	$scope.start = '';
	$scope.end = '';
	$rootScope.hhorders = Horders.get();
	
	Horders.status();
	Horders.pay();
	
	if($routeParams.id !== undefined)
	{
		$scope.viewhorder = Horders.view({id:$routeParams.id});
	}
	
	$rootScope.$on('horder:geted', function() {
	
		if ($scope.horders.length === 0) 
		{
			$scope.horders = Horders.get();
			$rootScope.horders = Horders.get();
		}
	});
	
	$rootScope.$on('status:viewed', function(event, data) {
		$scope.statuses = Horders.viewStatus();
	});
	
	$rootScope.$on('pay:viewed', function(event, data) {
		$scope.paids = Horders.viewPay();
	});
	
	$rootScope.$on('horder:viewed', function() {
		if ($scope.vieworder.length === undefined || $scope.vieworder.length === 0) 
		{
			$scope.vieworder = Horders.viewData();
		}
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
		var path = '/horders/unit/'+val;
		$location.path(path).replace();
	};
	
    $scope.$watch('currentPage', function(newPage){
			
			$scope.watchPage = newPage*$scope.maxSize - $scope.maxSize;
			$scope.maxSizes = newPage*$scope.maxSize;
	});
	
	$scope.reset = function(){
		
		window.location.reload();
		/*angular.forEach($rootScope.hhorders, function (val,key){
			$scope.horders.push(val);
		});*/
		
	};
	
//--------------------datapicker-------------------------
 
  $scope.disabled = function(date, mode) {
    //return ( mode === 'day' && ( date.getDay() === 0 || date.getDay() === 6 ) );
  };
  
  $scope.clear = function () {
    $scope.start = '';
	$scope.end = '';
  };

  $scope.toggleMin = function() {
    $scope.minDate = $scope.minDate ? null : new Date();
  };
  $scope.toggleMin();

  $scope.open = function($event) {
    $event.preventDefault();
    $event.stopPropagation();

    $scope.opened = true;
  };
  
  $scope.openNext = function($event) {
    $event.preventDefault();
    $event.stopPropagation();

    $scope.openedNext = true;
  };

  $scope.dateOptions = {
    formatYear: 'yy',
    startingDay: 1
  };

  $scope.formats = ['dd.MM.yyyy HH:mm:ss'];
  $scope.format = $scope.formats[0];

	$scope.$watch('horders', function() { 
		
			$scope.horders = Horders.get();
		
	});
		
}]);