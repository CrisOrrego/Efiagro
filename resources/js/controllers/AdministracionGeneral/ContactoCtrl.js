//INICIO DEV ANGELICA
angular.module('ContactoCtrl', [])
.controller('ContactoCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog', 
	function($scope, $rootScope, $http, $injector, $mdDialog) {

		console.info('ContactoCtrl');
		var Ctrl = $scope;
		var Rs = $rootScope;
		
		var TiposCasos = ['Whatsapp', 'SMS', 'Llamada telefonica'];

		Ctrl.ContactoCRUD = $injector.get('CRUD').config({ 
			base_url: '/api/casos/casos',
			limit: 1000,
			add_append: 'refresh',
			query_with: [ 'solicitante' ],
			order_by: [ '-created_at' ]
		});

		//Inicio Dev Angélica
		//Filtra el tipo (sólo muestra los casos que deben aparecer en pantalla)-->'Consulta General', 'Apoyo Tecnico', 'Contar Experiencia'[ver archivo Caso.php]
		Ctrl.ContactoCRUD.setScope('tipocontacto');
		//Fin Dev Angélica

		Ctrl.UsuariosCRUD = $injector.get('CRUD').config({ base_url: '/api/usuario/usuarios' });


		Ctrl.getCasos = () => {
			Promise.all([
				Ctrl.UsuariosCRUD.get()
			]).then(() => {
				Ctrl.ContactoCRUD.get().then(() => {
					//Ctrl.editarArticulo(Ctrl.CasosCRUD.rows[1]);
				});
			});
			
			
		};

		Ctrl.getCasos();

		Ctrl.nuevoContacto = () => {

			Rs.BasicDialog({
				Flex: 30,
				Title: 'Crear Nuevo Contacto',
				Fields: [
					{ Nombre: 'Asociado',  Value: null, Type: 'list', List: Ctrl.UsuariosCRUD.rows, Required: false, Item_Val: 'id', Item_Show: 'nombre' },
					{ Nombre: 'Tipo de Caso', Value: TiposCasos[0], Type: 'simplelist', List: TiposCasos, Required: true },
					{ Nombre: 'Describe el Caso',       Value: '', Type: 'textarea', Required: true, opts: { rows: 3 } }
				],
				Confirm: { Text: 'Crear Contacto' },
			}).then(r => {
				if(!r) return;

				var NuevoContacto = {
					titulo: r.Fields[2].Value,
					solicitante_id: r.Fields[0].Value,
					tipo: r.Fields[1].Value,
					asignados: '[]'
				};

				Ctrl.ContactoCRUD.add(NuevoContacto);
			});

		};


		Ctrl.editarContacto = (C) => {

			Rs.BasicDialog({
				Flex: 30,
				Title: 'Editar Nuevo Contacto',
				Fields: [
					{ Nombre: 'Asociado',         Value: C.solicitante_id, Type: 'list', List: Ctrl.UsuariosCRUD.rows, Required: false, Item_Val: 'id', Item_Show: 'nombre' },
					{ Nombre: 'Tipo de Caso',     Value: C.tipo, Type: 'simplelist', List: TiposCasos, Required: true },
					{ Nombre: 'Describe el Caso', Value: C.titulo, Type: 'textarea', Required: true, opts: { rows: 3 } }
				],
				Confirm: { Text: 'Editar Contacto' },
			}).then(r => {
				if(!r) return;

				var ContactoEditado = {
					id: C.id,
					titulo: r.Fields[2].Value,
					solicitante_id: r.Fields[0].Value,
					tipo: r.Fields[1].Value,
					asignados: '[]'
				};

				Ctrl.ContactoCRUD.update(ContactoEditado).then(() => {
					Ctrl.ContactoCRUD.get();
				});
				
			});

		}

		Ctrl.eliminarContacto = (C) => {
			Rs.confirmDelete({
				Title: '¿Eliminar el contacto #'+C.id+'?',
			}).then(d => {
				if(!d) return;
				Ctrl.ContactoCRUD.delete(C);
			});
		}
	}
]);
//FIN DEV ANGELICA