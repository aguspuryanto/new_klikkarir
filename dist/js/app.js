var myApp = angular.module("myApp", []);

/* .filter('slugify', function () {
    return function (input) {
         // make lower case and trim
        var slug = input.trim();
         // replace invalid chars with spaces
        slug = slug.replace(/[^a-z0-9-]/gi, '-').
			replace(/-+/g, '-').
			replace(/^-|-$/g, '');
         // replace multiple spaces or hyphens with a single hyphen
        slug = slug.toLowerCase();
        return slug;
    };
}) */

myApp.controller("myCtrl", function($scope, $http) {
    /* $scope.firstName = "John";
    $scope.lastName = "Doe"; */
	
	$scope.frontbycity = [];
	$scope.frontbycate = [];
	
	var promise = $http.get( baseUrl + "/api/frontByCity")
    .then(function (response) {
		// console.log(response);
		$scope.frontbycity = response.data;
	});
	
	var promise = $http.get( baseUrl + "/api/frontByCategory")
    .then(function (response) {
		// console.log(response);
		$scope.frontbycate = response.data;
	});
	
	$scope.slugify = function(input){
		// console.info( input );
		
		var slug = $.trim(input).replace(/[^a-z0-9-]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, '');
         // replace multiple spaces or hyphens with a single hyphen
        slug = slug.toLowerCase();
        return slug;
	}
});