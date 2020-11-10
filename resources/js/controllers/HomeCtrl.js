angular.module('HomeCtrl', [])
.controller('HomeCtrl', ['$scope', '$rootScope', '$http', '$state', '$mdDialog', 
	function($scope, $rootScope, $http, $state, $mdDialog) {

		console.info('HomeCtrl');
		var Ctrl = $scope;
		var Rs = $rootScope;

		Ctrl.Logout = () => {
			let confirm = $mdDialog.confirm()
							.title('¿Desea salir del aplicativo?')
							.ok('Cerrar Sesion')
							.cancel('Regresar');

			$mdDialog.show(confirm).then(() => {
				$state.go('Login');
			});
		}
	}
]);