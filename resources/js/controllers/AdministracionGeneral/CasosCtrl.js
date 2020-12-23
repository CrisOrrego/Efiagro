angular.module('CasosCtrl', [])
.controller('CasosCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog', 
	function($scope, $rootScope, $http, $injector, $mdDialog) {

		console.info('CasosCtrl');
		var Ctrl = $scope;
		var Rs = $rootScope;
	
		Ctrl.CasosCRUD = $injector.get('CRUD').config({ 
			base_url: '/api/casos/casos',
			limit: 1000,
			add_append: 'refresh',
			query_with: [ 'solicitante' ],
			order_by: [ '-created_at' ]
		});

		Ctrl.getCasos = () => {
			Ctrl.CasosCRUD.get().then(() => {
				//Ctrl.editarArticulo(Ctrl.CasosCRUD.rows[1]);
			});
		};

		Ctrl.getCasos();

		Ctrl.nuevoCaso = () => {
			Ctrl.CasosCRUD.dialog({
				solicitante_id: Rs.Solicitante_id,
				estado: 'Borrador'
			}, {
				title: 'Nuevo Caso',
				only: ['titulo']
			}).then(r => {
				if(!r) return;
				Ctrl.CasosCRUD.add(r);
			});

		};


		Ctrl.editarCaso = (C) => {
			$mdDialog.show({
				templateUrl: 'Frag/AdministracionGeneral.Casos_CasoEditorDiag',
				controller: 'Casos_CasoEditorCtrl',
				locals: { Caso: C },
				scope: Ctrl.$new()
			});
		}


	}
]);