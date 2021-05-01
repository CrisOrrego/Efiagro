angular.module('LoginCtrl', [])
.controller('LoginCtrl', ['$rootScope', '$http', '$state', '$localStorage', '$mdToast', 
	function($rootScope, $http, $state, $localStorage, $mdToast){

		console.log('LoginCtrl');

		var Rs = $rootScope;

		delete $localStorage.token;

		Rs.Usuario = {
			Correo: 'info@mbrain.co',
			Password: '12345'
		};

		Rs.enviarLogin = (ev) => {
			ev.preventDefault();
			
			$http.post('/api/usuario/login', { Credenciales: Rs.Usuario })
			.then((r) => {
				let token = r.data;
				$localStorage.token = token;
				$state.go('Home');
			}).catch( resp => {
				Rs.showToast(resp.data.Msg);
			});
		}

		Rs.def = function(arg, def) {
			return (typeof arg == 'undefined' ? def : arg);
		};

		Rs.showToast = function(Msg, Type, Delay = 5000, Position){

			var Type = Rs.def(Type, 'Normal');
			var Position = Rs.def(Position, 'bottom left')

			var Templates = {
				Normal: '<md-toast class="md-toast-normal"><span flex>' + Msg + '<span></md-toast>',
				Error:  '<md-toast class="md-toast-error"><span flex>' + Msg + '<span></md-toast>',
				Success:  '<md-toast class="md-toast-success"><span flex>' + Msg + '<span></md-toast>',
			};
			return $mdToast.show({
				template: Templates[Type],
				hideDelay: Delay,
				position: Position
			});
		};

	}
]);