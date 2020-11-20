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
				Ctrl.ArticulosCRUD.add(r);
			});

		};

	}
]);