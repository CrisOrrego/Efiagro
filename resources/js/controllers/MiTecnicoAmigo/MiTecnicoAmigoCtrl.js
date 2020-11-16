angular.module('MiTecnicoAmigoCtrl', [])
.controller('MiTecnicoAmigoCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog', 
	function($scope, $rootScope, $http, $injector, $mdDialog) {

		console.info('MiTecnicoAmigoCtrl');
		var Ctrl = $scope;
		var Rs = $rootScope;

		$http.post('api/articulos/obtener', {}).then(r => {
			Ctrl.Articulos = r.data;

			Ctrl.abrirArticulo(Ctrl.Articulos[0]); //FIX
		});

		Ctrl.abrirArticulo = (A) => {
			$mdDialog.show({
				templateUrl: 'Frag/MiTecnicoAmigo.ArticuloDiag',
				controller: 'ArticuloDiagCtrl',
				locals: { Articulo: A },
				fullscreen: false,
			});
		}

	}
]);