angular.module('appRoutes', [])
.config(['$stateProvider', '$urlRouterProvider', '$httpProvider', 
	function($stateProvider, $urlRouterProvider, $httpProvider){

		$stateProvider
			.state('Login', {
				url: '/Login',
				templateUrl: '/Login'
			})
			.state('Home', {
				url: '/Home',
				templateUrl: '/Home'
			});

	}
]);