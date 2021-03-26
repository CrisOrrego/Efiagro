angular.module('ArticulosCtrl', [])
.controller('ArticulosCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog', 
	function($scope, $rootScope, $http, $injector, $mdDialog) {

		console.info('ArticulosCtrl');
		var Ctrl = $scope;
		var Rs = $rootScope;
	
		Ctrl.ArticulosCRUD = $injector.get('CRUD').config({ 
			base_url: '/api/articulos/articulos',
			limit: 1000,
			add_append: 'refresh',
			query_with: [ 'autor' ],
			order_by: [ '-created_at' ]
		});

		Ctrl.getArticulos = () => {
			Ctrl.ArticulosCRUD.get().then(() => {
				//Ctrl.editarArticulo(Ctrl.ArticulosCRUD.rows[0]);
			});
		};

		Ctrl.getArticulos();

		Ctrl.nuevoArticulo = () => {

			Ctrl.ArticulosCRUD.dialog({
				usuario_id: Rs.Usuario.id,
				estado: 'Borrador'
			}, {
				title: 'Nuevo Articulo',
				only: ['titulo']
			}).then(r => {
				if(!r) return;
				Ctrl.ArticulosCRUD.add(r);
			});

		};


		Ctrl.editarArticulo = (A) => {
			$mdDialog.show({
				templateUrl: 'Frag/AdministracionGeneral.Articulos_ArticuloEditorDiag',
				controller: 'Articulos_ArticuloEditorCtrl',
				locals: { Articulo: A },
				scope: Ctrl.$new()
			});
		}


	}
]);