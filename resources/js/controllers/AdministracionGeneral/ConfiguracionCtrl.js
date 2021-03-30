//INICIO DEV ANGELICA
angular.module('ConfiguracionCtrl', [])
.controller('ConfiguracionCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog', 
	function($scope, $rootScope, $http, $injector, $mdDialog) {

		console.info('ConfiguracionCtrl');
		var Ctrl = $scope;
		var Rs = $rootScope;
		
		var autoincrementals = ['Si', 'No'];

		Ctrl.ListaCRUD = $injector.get('CRUD').config({ 
			base_url: '/api/lista/listas',
			limit: 1000,
			add_append: 'refresh',
			order_by: [ '-lista' ]
		});


		Ctrl.getListas = () => {
			Promise.all([
				Ctrl.ListaCRUD.get()
			]).then(() => {
			});
			
		};

		Ctrl.getListas();

		Ctrl.nuevaLista = () => {

			Rs.BasicDialog({
				Flex: 30,
				Title: 'Crear Nueva Lista',
				Fields: [
					{ Nombre: 'lista',  Value: '', Type: 'textarea', Required: true},
					{ Nombre: 'autoincremental', Value: autoincrementals[0], Type: 'simplelist', List: autoincrementals, Required: true }
				],
				Confirm: { Text: 'Crear Lista' },
			}).then(r => {
				if(!r) return;
				debugger;

				var NuevaLista = {
					lista: r.Fields[0].Value,
					autoincremental: r.Fields[1].Value === 'Si' ? 1:0
				};

				Ctrl.ListaCRUD.add(NuevaLista);
			});

		};

		//INICIO DEV ANGÉLICA 
		//Abre el modal para editar una lista
		Ctrl.editarLista = (O) => {
			$mdDialog.show({
				templateUrl: 'Frag/AdministracionGeneral.ListaEditorDiag',
				controller: 'ListaEditDialogCtrl',
				locals: {Lista: O},
				fullscreen: false,
			}).then(function (resp) {
				//Ctrl.OrganizacionesmuroseccionesCRUD.setScope('elorganizacion', Rs.Usuario.organizacion_id).get();
			}, function (resp) {
				console.log('Error status: ' + resp.status); 
			});

		}

		
		Ctrl.eliminarLista = (C) => {
			Rs.confirmDelete({
				Title: '¿Eliminar la lista #'+C.id+'?',
			}).then(d => {
				if(!d) return;
				Ctrl.ListaCRUD.delete(C);
			});
		}
	}
]);
//FIN DEV ANGELICA