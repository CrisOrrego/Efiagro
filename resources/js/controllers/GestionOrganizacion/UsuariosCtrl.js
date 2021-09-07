// angular.module('UsuariosCtrl', [])
// .controller('UsuariosCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog', 
// 	function($scope, $rootScope, $http, $injector, $mdDialog) {

// 		// console.info('UsuariosCtrl');
// 		var Ctrl = $scope;
// 		var Rs = $rootScope;
	
// 		Ctrl.UsuariosCRUD = $injector.get('CRUD').config({ 
// 			base_url: '/api/usuario/usuarios',
// 			limit: 100,
// 			add_append: 'refresh',
// 		});
		
// 		Ctrl.getUsuarios = () => {
// 			Ctrl.UsuariosCRUD.get().then(() => {
// 				//Ctrl.nuevoUsuario(); //FIX
// 			});
// 		};

// 		Ctrl.getUsuarios();

// 		Ctrl.nuevoUsuario = () => {
// 			Ctrl.UsuariosCRUD.dialog({}, {
// 				title: 'Agregar Usuario',
// 			}).then(r => {
// 				Ctrl.UsuariosCRUD.add(r).then(() => {
// 					Rs.showToast('Usuario creado');
// 				});
// 			});
// 		}

// 		Ctrl.editarUsuario = (U) => {
// 			Ctrl.UsuariosCRUD.dialog(U, {
// 				title: 'Editar el usuario' + U.nombres
// 			}).then(r => {
// 				if(r == 'DELETE') return Ctrl.UsuariosCRUD.delete(U);
// 				Ctrl.UsuariosCRUD.update(r).then(() => {
// 					Rs.showToast('Usuario actualizado');
// 				});
// 			});
// 		}


// 	}
// ]);