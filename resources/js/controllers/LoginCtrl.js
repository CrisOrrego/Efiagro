angular.module('LoginCtrl', [])
.controller('LoginCtrl', ['$rootScope', 
	function($rootScope){

		console.log('LoginCtrl');

		let Rs = $rootScope;

		
		Rs.Usuario = {
			Correo: 'Hola',
			Password: 'Mundo'
		};


	}
]);