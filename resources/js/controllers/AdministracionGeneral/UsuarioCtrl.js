angular.module('UsuariosCtrl', [])
    .controller('UsuariosCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog',
        function($scope, $rootScope, $http, $injector, $mdDialog) {
         
            var Ctrl = $scope;
            var Rs = $rootScope; 

            // Cargar CRUD angular para Usuarios
            Ctrl.UsuariosCRUD = $injector.get('CRUD').config({
                base_url: '/api/usuario/usuarios',
                limit: 100,
                add_append: 'refresh',
                query_with: ['perfil'],
            });

            Ctrl.getUsuarios = () => {
                // Asignar organizacion por defecto y obtener la informacion del usuario
                // 20210505 Se quita funcion de filtrar por Organizacion.
                // Ctrl.UsuariosCRUD.setScope('laorganizacion', Rs.Usuario.organizacion_id); 
                Ctrl.UsuariosCRUD.get().then(() => {});
            };
            Ctrl.getUsuarios();

            // Modal para la creacion del usuario.
            Ctrl.nuevo = () => {
                Ctrl.UsuariosCRUD.dialog({ 
                    tipo_documento: 'CC', 
                    organizacion_id: Rs.Usuario.organizacion_id
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

            // Modal para la edicion de los datos del usuarios
            Ctrl.editarUsuario = (U) => {
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

            // Moda para el cambio de clave del usuario
            Ctrl.cambiarClave = U => {
                Rs.BasicDialog({
                    Flex: 30,
                    Title: `Cambiar Clave ${ U.nombres }` ,
                    Fields: [
                        {
                            Nombre: "Nueva Clave",
                            Value: '', //U.contrasena,
                            Type: "string",
                            Required: true,
                        },
                    ],
                    Confirm: { Text: "Actualiza Clave" }
                }).then(u => {
                    if (!u) return;

                    var nuevaclave = u.Fields[0].Value;
                    if ( nuevaclave.trim() != '' ) {
                        var ClaveCambiada = {
                            usuario_id: U.id,
                            contrasena: u.Fields[0].Value,
                        };
                        // Accedemos mediante la API para el cambio de clave.
                        $http.post('/api/usuario/actualizar-clave', ClaveCambiada)
                            .then( () => {
                                Rs.showToast("Se cambio la clave.");
                            });
                    } else {
                        Rs.showToast("Se envio la clave en blanco. No se modifica.");
                    }
                });
            };

            // Modal para la carga de las fincas y las zonas del usuario seleccionado.
            Ctrl.cargarFincas = ( U ) => {
                $mdDialog.show({
                    templateUrl: 'Frag/AdministracionGeneral.UsuarioFincas',
                    controller: 'UsuarioFincaCtrl',
                    locals: { 
                        DatosUsuario: U 
                    },
                    fullscreen: false,
                });
            };
        }
    ]);
