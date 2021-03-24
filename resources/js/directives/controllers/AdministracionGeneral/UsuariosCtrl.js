angular.module('UsuariosCtrl', [])
    .controller('UsuariosCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog',
        function($scope, $rootScope, $http, $injector, $mdDialog) {
            //console.info('UsuariosCtrl');
            var Ctrl = $scope;
            var Rs = $rootScope; 

            Ctrl.UsuariosCRUD = $injector.get('CRUD').config({
                base_url: '/api/usuario/usuarios',
                limit: 100,
                add_append: 'refresh',
                query_with: ['perfil'], // , 'perfiles'
            });
            Ctrl.getUsuarios = () => {
                Ctrl.UsuariosCRUD.setScope('laorganizacion', Rs.Usuario.organizacion_id);
                Ctrl.UsuariosCRUD.get().then(() => {});
            };
            Ctrl.getUsuarios();

            Ctrl.nuevo = () => {
                Ctrl.UsuariosCRUD.dialog({ 
                    tipo_documento: 'CC', 
                    organizacion_id: Rs.Usuario.organizacion_id,
                    contrasena: '1234', 
                }, {
                    title: 'Agregar Usuario',
                    except: [
                        'finca_id',
                        'organizacion_id',
                    ],
                }).then(U => {
                    if ( !U ) return;
                    Ctrl.UsuariosCRUD.add(U)
                        .then(() => {
                            Rs.showToast('Usuario creado');
                        });
                });
            };

            Ctrl.editarUsuario = (U) => {
                //console.log(U);
                Ctrl.UsuariosCRUD.dialog(U, {
                    title: `Editar usuario: ${ U.nombres } ${ U.apellidos }`,
                    except: [
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

            // Ctrl.guardarU = (U) => {
            //     Ctrl.UsuariosCRUD.update(U);
            // };
        }

    ]);