angular.module('LoginCtrl', [])
.controller('LoginCtrl', ['$rootScope', '$http', 
	function($rootScope, $http){

		console.log('LoginCtrl');

		let Rs = $rootScope;

		
		Rs.Usuario = {
			Correo: 'info@mbrain.co',
			Password: '12345'
		};

		Rs.enviarLogin = (ev) => {
			ev.preventDefault();
			
			$http.post('/api/usuario/login', { Credenciales: Rs.Usuario }).then((r) => {
				console.log(r);
			});
		}

	}
]);