angular.module('Casos_CasoEditorCtrl', [])
.controller('Casos_CasoEditorCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog', 'Articulo',
	function($scope, $rootScope, $http, $injector, $mdDialog, Articulo) {

		console.info('Casos_CasoEditorCtrl');
		var Ctrl = $scope;
		var Rs = $rootScope;

		Ctrl.Cancel = $mdDialog.cancel;

		Ctrl.Caso = angular.copy(Caso);

		Ctrl.SeccionesCRUD = $injector.get('CRUD').config({ 
			base_url: '/api/casos/secciones',
			limit: 1000,
			add_append: 'refresh',
		});

		Ctrl.getSecciones = () => {
			Ctrl.SeccionesCRUD.setScope('elcaso', Caso.id).get();
		}
		Ctrl.getCasos();

	}
]);