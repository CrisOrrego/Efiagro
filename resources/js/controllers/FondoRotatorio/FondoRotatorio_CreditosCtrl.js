angular.module('FondoRotatorio_CreditosCtrl', [])
.controller('FondoRotatorio_CreditosCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog', 
	function($scope, $rootScope, $http, $injector, $mdDialog) {

		console.info('FondoRotatorio_CreditosCtrl');
		var Ctrl = $scope;
		var Rs = $rootScope;
		Ctrl.AsociadosNav = true;
		Ctrl.Asociado = null;
	
		Ctrl.buscarAsociados = (query) => {
			return Rs.http('api/usuario/buscar-usuario', { 'query': query });
		}

		Ctrl.selectAsociado = (Asociado) => {
			Ctrl.Asociado = Asociado;
		}

		/*Rs.http('api/usuario/buscar-usuario', { 'query': '1093' }).then(r => {
			Ctrl.Asociado = r[0];
			Ctrl.nuevoCredito();
		});*/

		Ctrl.nuevoCredito = function(){
			$mdDialog.show({
				controller: 'FondoRotatorio_NuevoCreditoDiagCtrl',
				templateUrl: '/Frag/FondoRotatorio.Creditos_NuevoCreditoDiag',
				clickOutsideToClose: false,
				locals: { Asociado: Ctrl.Asociado, myUser: Rs.Usuario, Parent: Ctrl, Simulate: false },
				fullscreen: true,
			}).then(function(Cred) { 
				//Ctrl.ViewCredit(Cred);
				//Ctrl.LoadCreditos();
			});
		}

	}
]);