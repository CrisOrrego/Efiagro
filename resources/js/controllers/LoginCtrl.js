angular.module('LoginCtrl', [])
.controller('LoginCtrl', ['$rootScope', '$http', '$state', '$localStorage', 
	function($rootScope, $http, $state, $localStorage){

		console.log('LoginCtrl');

		let Rs = $rootScope;

		delete $localStorage.token;

		Rs.Usuario = {
			Correo: 'info@mbrain.co',
			Password: 'kasdfjkl9r90jr'
		};

		Rs.enviarLogin = (ev) => {
			ev.preventDefault();
			
			$http.post('/api/usuario/login', { Credenciales: Rs.Usuario }).then((r) => {
				let token = r.data;
				$localStorage.token = token;
				$state.go('Home');
			});
		}

	}
]);