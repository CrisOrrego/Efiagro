angular.module('Articulos_ArticuloEditorCtrl', [])
.controller('Articulos_ArticuloEditorCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog', 'Articulo',
	function($scope, $rootScope, $http, $injector, $mdDialog, Articulo) {

		console.info('Articulos_ArticuloEditorCtrl');
		var Ctrl = $scope;
		var Rs = $rootScope;

		Ctrl.Cancel = $mdDialog.cancel;

		Ctrl.Articulo = angular.copy(Articulo);

		Ctrl.SeccionesCRUD = $injector.get('CRUD').config({ 
			base_url: '/api/articulos/secciones',
			limit: 1000,
			add_append: 'refresh',
		});

		Ctrl.TiposSeccion = {
			'Parrafo': { Nombre: 'Párrafo', Icono: 'fa-align-justify' },
			'Imagen':  { Nombre: 'Imágen',  Icono: 'fa-image' }
		};

		Ctrl.getSecciones = () => {
			Ctrl.SeccionesCRUD.setScope('elarticulo', Articulo.id).get();
		}

		Ctrl.getSecciones();

		Ctrl.guardarArticulo = () => {
			Ctrl.$parent.ArticulosCRUD.update(Ctrl.Articulo).then(() => {
				var SeccionesCambiadas = Ctrl.SeccionesCRUD.rows.filter(s => s.changed);
				if(SeccionesCambiadas.length > 0){
					Ctrl.SeccionesCRUD.updateMultiple(SeccionesCambiadas).then(() => {
						console.log('Secciones Actualizadas');
					});
				}
			});
		}

		Ctrl.crearSeccion = (kT) => {
			Ctrl.SeccionesCRUD.add({
				articulo_id: Articulo.id,
				tipo: kT
			});
		}

	}
]);