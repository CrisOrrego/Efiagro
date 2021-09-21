angular.module('FondoRotatorio_ListadoCtrl', [])
.controller('FondoRotatorio_ListadoCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog', 
	function($scope, $rootScope, $http, $injector, $mdDialog) {

		console.info('FondoRotatorio_ListadoCtrl');
		var Ctrl = $scope;
		var Rs = $rootScope;
	
		Ctrl.CreditosCRUD = $injector.get('CRUD').config({ 
			base_url: '/api/creditos/crud',
			query_with: ['afiliado', 'afiliado.fincas', 'usuario']
		});

		Ctrl.getListado = () => {
			Ctrl.CreditosCRUD
				.setScope('organizacion', Rs.Usuario.organizacion_id)
				.get().then(() => {
				
			});
		};

		Ctrl.printCredit = function(C, ev){

			var Organizacion = Rs.Usuario.organizaciones.find(e => e.id == Rs.Usuario.organizacion_id);

			$http.get('/api/creditos/?id='+C.id).then(function(res){
				$mdDialog.show({
					controller: 'FondoRotatorio__Creditos_CreditoDialogCtrl',
					templateUrl: '/Frag/FondoRotatorio.Creditos_CreditoDialog',
					clickOutsideToClose: true,
					locals: { Organizacion, CredSel: res.data, Asociado: C.afiliado },
					fullscreen: true,
					targetEvent: ev,
				});
			});


		}

		Ctrl.getListado();

	}
]);