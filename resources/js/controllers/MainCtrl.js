angular.module('MainCtrl', [])
.controller('MainCtrl', ['$rootScope', 
	function($rootScope){

		console.log('MainCtrl');

		let Rs = $rootScope;

		Rs.Saludo = 'Hola Mundo 999';


	}
]);