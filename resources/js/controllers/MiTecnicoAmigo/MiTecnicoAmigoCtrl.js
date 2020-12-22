angular.module('MiTecnicoAmigoCtrl', [])
.controller('MiTecnicoAmigoCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog', 
	function($scope, $rootScope, $http, $injector, $mdDialog) {

		console.info('MiTecnicoAmigoCtrl');
		var Ctrl = $scope;
		var Rs = $rootScope;

		//Ctrl.Subseccion = 'Articulos';
		Ctrl.Subseccion = 'Solicitudes';

		$http.post('api/articulos/obtener', {}).then(r => {
			Ctrl.Articulos = r.data;
			//Ctrl.abrirArticulo(Ctrl.Articulos[3]); //FIX
		});

		Ctrl.abrirArticulo = (A) => {
			$mdDialog.show({
				templateUrl: 'Frag/MiTecnicoAmigo.ArticuloDiag',
				controller: 'ArticuloDiagCtrl',
				locals: { Articulo: A },
				fullscreen: false,
			});
		}



		//Casos
		Ctrl.CasosCRUD = $injector.get('CRUD').config({ 
			base_url: '/api/casos/casos',
			limit: 1000,
			add_append: 'refresh',
			query_with: [],
			order_by: []
		});

		Ctrl.getCasos = () => {
			Ctrl.CasosCRUD.get();
		}

		Ctrl.getCasos();

		Ctrl.crearCaso = () => {
			var OpcionesTipo = [
				[ 'Tengo una Duda General', 'Consulta General'],
				[ 'Necesito Ayuda Técnica', 'Apoyo Técnico' ],
				[ 'Quiero Contar Una Experiencia', 'Contar Experiencia' ]
			];

			Rs.BasicDialog({
				Flex: 30,
				Title: 'Crear Nueva Solicitud',
				Fields: [
					{ Nombre: '¿En Qué Puedo Ayudarte?',  Value: 'Tengo una Duda General', Type: 'simplelist', List: OpcionesTipo.map(a => a[0]), Required: true },
					{ Nombre: 'Describe el Caso',       Value: '', Type: 'textarea', Required: true, opts: { rows: 3 } }
				],
				Confirm: { Text: 'Crear Solicitud' },
			}).then(r => {
				if(!r) return;

				var NuevoCaso = {
					titulo: r.Fields[1].Value,
					solicitante_id: Rs.Usuario.id,
					tipo: OpcionesTipo.find(a => a[0] == r.Fields[0].Value)[1],
					asignados: '[]'
				};

				Ctrl.CasosCRUD.add(NuevoCaso);


			});
		}


	}
]);