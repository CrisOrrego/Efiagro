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
			'Tabla':   { Nombre: 'Tabla',   Icono: 'fa-table' },
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

		Ctrl.crearSeccion = async (kT) => {

			var ruta = null;
			var contenido = null;

			if(kT == 'Imagen'){
				var Img = await $mdDialog.show({
					templateUrl: 'templates/dialogs/image-editor.html',
					controller: 'ImageEditor_DialogCtrl',
					multiple: true,
					locals: { 
						Config: {
							Theme: 'default',
							CanvasWidth:  600,			//Ancho del canvas
							CanvasHeight: 400,			//Alto del canvas
							CropWidth:  600,			//Ancho del recorte que se subirá
							CropHeight: 400,			//Alto del recorte que se subirá
							MinWidth:  60,				//Ancho mínimo del selector
							MinHeight: 40,				//Ancho mínimo del selector
							KeepAspect: true,
							Preview: false,	
							Daten: {
								Path: 'files/articulos_media/' + Articulo.id + '/' + moment().format('YYYYMMDDHHmmss') + '.jpg'

							}
						}
					}
				});

				if(Img) ruta = Img.Msg;
			}

			if(kT == 'Tabla'){
				contenido = [ [ 'Uno', 'Dos', 'Tres' ], [1,2,3], [4,5,6], [7,8,9] ];
			};

			console.table(contenido);

			Ctrl.SeccionesCRUD.add({
				articulo_id: Articulo.id,
				tipo: kT,
				ruta: ruta,
				contenido: contenido
			});
		}

		Ctrl.eliminarSeccion = (S) => {
			Rs.confirmDelete({
				Title: '¿Eliminar la Sección?',
			}).then(R => {
				if(!R) return;
				Ctrl.SeccionesCRUD.delete(S);
			});
		}

	}
]);