angular.module('LoginCtrl', [])
.controller('LoginCtrl', ['$rootScope', '$http', '$state',
	function($rootScope, $http, $state){

		console.log('LoginCtrl');

		let Rs = $rootScope;

		
		Rs.Usuario = {
			Correo: 'info@mbrain.co',
			Password: '12345'
		};

		Rs.enviarLogin = (ev) => {
			ev.preventDefault();
			
			$http.post('/api/usuario/login', { Credenciales: Rs.Usuario }).then((r) => {
				$state.go('Home');
			});
		}

	}
]);