angular.module('UsuariosCtrl', [])
    .controller('UsuariosCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog',
        function($scope, $rootScope, $http, $injector, $mdDialog) {
            //console.info('UsuariosCtrl');
            var Ctrl = $scope;
            var Rs = $rootScope; 

            // Obtener la configuración de CRUD con los datos para Usuarios
            Ctrl.UsuariosCRUD = $injector.get('CRUD').config({
                base_url: '/api/usuario/usuarios',
                limit: 100,
                add_append: 'refresh',
                query_with: ['perfil'],
            });
            Ctrl.getUsuarios = () => {
                Ctrl.UsuariosCRUD.setScope('laorganizacion', Rs.Usuario.organizacion_id);
                Ctrl.UsuariosCRUD.get().then(() => {});
            };
            Ctrl.getUsuarios();

            // Método para el modal de nuevo registro.
            Ctrl.nuevo = () => {
                Ctrl.UsuariosCRUD.dialog({ 
                    tipo_documento: 'CC', 
                    organizacion_id: Rs.Usuario.organizacion_id,
                }, {
                    title: 'Agregar Usuario',
                    except: [
                        'finca_id',
                        'organizacion_id',
                    ],
                }).then(U => {
                    // Retornamos a la pagina principal, si se cancela el modal de NUEVO.
                    if ( !U ) return;
                    Ctrl.UsuariosCRUD.add(U)
                        .then(() => {
                            Rs.showToast('Usuario creado');
                        });
                });
            };

            // Modal para la edición de usuarios
            Ctrl.editarUsuario = (U) => {
                Ctrl.UsuariosCRUD.dialog(U, {
                    title: `Editar usuario: ${ U.nombres } ${ U.apellidos }`,
                    except: [
                        'contrasena',
                        'finca_id',
                        'organizacion_id',
                    ],
                }).then(r => {
                    if ( !r ) return;
                    if(r == 'DELETE') return Ctrl.UsuariosCRUD.delete(U);
                    Ctrl.UsuariosCRUD.update(r).then(() => {
                        Ctrl.UsuariosCRUD.get();
                        Rs.showToast(`Usuario ${ U.nombres } actualizado`);
                    });
                });
            }; 

            // Modal para la modificación de la clave de acceso
            Ctrl.claveUsuario = (U) => {
                Ctrl.UsuariosCRUD.dialog(U, {
                    title: `Editar usuario: ${ U.nombres } ${ U.apellidos }`,
                    only: [
                        'contrasena',
                    ],
                }).then(r => {
                    if ( !r ) return;
                    if(r == 'DELETE') return Ctrl.UsuariosCRUD.delete(U);
                    Ctrl.UsuariosCRUD.update(r).then(() => {
                        Ctrl.UsuariosCRUD.get();
                        Rs.showToast(`Usuario ${ U.nombres } actualizado`);
                    });
                });
            };
        }

    ]);