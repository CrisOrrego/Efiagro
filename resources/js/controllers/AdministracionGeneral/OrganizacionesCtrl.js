angular.module("OrganizacionesCtrl", []).controller("OrganizacionesCtrl", [
    "$scope",
    "$rootScope",
    "$http",
    "$injector",
    "$mdDialog",
    "Upload",  //DEV ANGÉLICA --> 
    function($scope, $rootScope, $http, $injector, $mdDialog, Upload) {
        console.info("OrganizacionesCtrl");
        var Ctrl = $scope;
        var Rs = $rootScope;
        var departamentos = [];

        Ctrl.Salir = $mdDialog.cancel;
		
        Ctrl.OrganizacionesCRUD = $injector.get("CRUD").config({
            
            base_url: "/api/organizaciones/organizaciones",
            limit: 1000,
            add_append: "refresh",
            order_by: ["-created_at"]
        });

        Ctrl.value = 0;

        Ctrl.myHTML =
        'I am an <code>HTML</code>string with ' +
        '<a href="#">links!</a> and other <em>stuff</em>';
        
        //INICIO DEV ANGÉLICA -- MURO
        Ctrl.OrganizacionesmuroseccionesCRUD = $injector.get('CRUD').config({ 
            base_url: '/api/organizacionesmurosecciones/organizacionesmurosecciones',
            limit: 1000,
			add_append: 'refresh',
            query_with: ['usuario'],
			order_by: [ '-created_at' ]
		});
        console.log(Ctrl.OrganizacionesmuroseccionesCRUD);

        /*
        Ctrl.selectChanged = function ()  {
            debugger;
            alert('Hola Mundo');
        }*/

        Ctrl.obtenerSecciones = (organizacion_id) => {
            // console.log('nos mostrara algo?');
            // console.log(Ctrl.OrganizacionesCRUD);
            Ctrl.OrganizacionesmuroseccionesCRUD.setScope('elorganizacion', organizacion_id).get();
		};
        //console.log(Ctrl.obtenerSecciones);

        //console.log(Ctrl.OrganizacionesmuroseccionesCRUD);

        //FIN DEV ANGÉLICA

        Ctrl.getOrganizacion = () => {
            console.log(Rs.Usuario.organizacion_id);
            // Ctrl.OrganizacionesCRUD.setScope('id', Rs.Usuario.organizacion_id); //con el setScope estoy haciendo un filtro en la BD para que él nos traiga sólo un registro
            Ctrl.OrganizacionesCRUD.get().then(() => {
                //Ctrl.Organizacion = Ctrl.OrganizacionesCRUD.rows.find(O => O.id === Rs.Usuario.organizacion_id);
                Ctrl.Organizacion = Ctrl.OrganizacionesCRUD.rows[0];
                Ctrl.obtenerSecciones(Ctrl.Organizacion.id);
                //Ctrl.editarOrganizacion(Ctrl.OrganizacionesCRUD.rows[0]);
            });
        };

        Ctrl.getOrganizacion();

        //INICIO DEV ANGPELICA
        loadDepartamentos = (col_departamento) => {

            col_departamento.Options.options = departamentos;

            /*departamentos.forEach(departamento => {
                let codigo = departamento.codigo;
                let descripcion = departamento.descripcion;
                col_departamento.Options.options = {...col_departamento.Options.options, 
                    [codigo]: descripcion // si quiero que en la base de datos se vea por codigos en departamento y municipio
                    //[descripcion]: descripcion // si quiero que en la base de datos se vea por nombres(descripcion) en departamento y municipio
                };
            });//Llena el select de departamentos
            */
        }

        loadMunicipios = (valorDepartamento, col_municipio) => {
            col_municipio.Options.options = {}; //limpia el select de municipios
            console.log(valorDepartamento);

            $http.post ('api/lista/obtener', { lista: 'Municipios', Op1: valorDepartamento }).then((r)=>{
                col_municipio.Options.options = r.data;
			});
            /*departamento.municipios.forEach(municipio => {
                let codigo = municipio.codigo;
                let descripcion = municipio.descripcion;
                col_municipio.Options.options = {...col_municipio.Options.options, 
                    //[codigo]: descripcion ----> si quiero que en la base de datos se vea por codigos en departamento y municipio
                    [descripcion]: descripcion // si quiero que en la base de datos se vea por nombres(descripcion) en departamento y municipio
                };
            }); //se trae los municipios del departamento escogido
            */
        }

        inicializarListaDepartamentoMunicipio = () => {
            let col_departamento = Ctrl.OrganizacionesCRUD.columns.find(c => c.Field == 'departamento');
            loadDepartamentos(col_departamento);
    
            col_departamento.Options.onChangeFn = (valorDepartamento) => {
                let col_municipio = Ctrl.OrganizacionesCRUD.columns.find(c => c.Field == 'municipio');
                loadMunicipios(valorDepartamento, col_municipio);
            }                        

        }
        //FIN DEV ANGÉLICA

        //INICIO DEV ANGÉLICA
        Ctrl.nuevaOrganizacion = () => {  //Esta es una función que me crea automaticamente la modal y lleva la informacion a la BD desde la modal de CRUD
            inicializarListaDepartamentoMunicipio();
        //FIN DEV ANGÉLICA  
            Ctrl.OrganizacionesCRUD.dialog({
                Flex: 10,
                Title: 'Crear Organización',
                Confirm: { Text: 'Crear Organizacion' },
            }).then(r => {
                if (!r) return;
                Ctrl.OrganizacionesCRUD.add(r);
            });
        };
       

        Ctrl.getDepartamentos = () => {
			$http.post ('api/lista/obtener', { lista: 'Departamentos' }).then((r)=>{
                departamentos = r.data;
                console.log(departamentos);
			});
		}

		Ctrl.getDepartamentos();

        Ctrl.editarOrganizacion = (O) => {
            inicializarListaDepartamentoMunicipio();
			Ctrl.OrganizacionesCRUD.dialog(O, {
				title: 'Editar Organización' + O.nombre
			}).then(r => {
				if(r == 'DELETE') return Ctrl.OrganizacionesCRUD.delete(O);
				Ctrl.OrganizacionesCRUD.update(r).then(() => {
					Rs.showToast('Organizacion actualizada');
				});
			});
		}

		Ctrl.eliminarOrganizacion = (O) => {
			Rs.confirmDelete({
				Title: '¿Eliminar Organizacion #'+O.id+'?',
			}).then(d => {
				if(!d) return;
				Ctrl.OrganizacionesCRUD.delete(O);
			});
        }

        //INICIO DEV ANGÉLICA

        /*Ctrl.abrirMuroDialog = () => {
            //console.log('es el caso ' + C.id);
            $mdDialog.show({
                templateUrl: 'Frag/GestionOrganizacion.OrganigramaDiag',
                //templateUrl: 'Frag/GestionOrganizacion.',
                controller: 'OrganizacionDiagCtrl',
                locals: {
                },
                //scope: Ctrl.$update()
            });
        };*/


        //FIN DEV ANGÉLICA

        //Abre el modal de publicaciones del muro 

		Ctrl.abrirOrganigrama = (O) => {
            // console.log(O);
			$mdDialog.show({
				templateUrl: 'Frag/GestionOrganizacion.OrganigramaDiag',
				controller: 'OrganizacionDiagCtrl',
				locals: { Organizacion: O },
				fullscreen: false,
			});
        }


    //INICIO DEV ANGÉLICA 
        //Abre el modal del un articulo de un muro de la organizacion
        Ctrl.abrirArticulomuro = (A) => {
            console.log(A);
			$mdDialog.show({
				//templateUrl: 'Frag/GestionOrganizacion.OrganizacionesmuroEditorDiag',
                templateUrl: 'templates/dialogs/image-editor.html',               
				controller: 'ImageEditor_DialogCtrl',
				locals: {Organizacionesmurosecciones: A},
			});
        }

                //Carga imagen al servidor
                Ctrl.subirImagen = ($file) => {
                    if(!$file) return;
        
                    Upload.upload({
                        url: 'api/main/upload-imagen',
                        data: {file: $file,
                            Path: 'files/muro_media/' + Rs.Usuario.organizacion_id + '/' + moment().format('YYYYMMDDHHmmss') + '.jpg',
                            Ancho: 560, Alto: 300, Quality: 90
                        }
                    }).then(function (resp) {
                        console.log('Success ' + resp.config.data.file.name + 'uploaded. Response: ' + resp.data);
                    }, function (resp) {
                        console.log('Error status: ' + resp.status);
                    });
                }
        
            
        //Abre el modal del un articulo de un muro de la organizacion
        Ctrl.nuevoArticuloMuro = (O) => {
            console.log(O);
			$mdDialog.show({
				templateUrl: 'Frag/GestionOrganizacion.OrganizacionesmuroEditorDiag',
				controller: 'ArticulomuroEditDialogCtrl',
				locals: {  },
				fullscreen: false,
			}).then(function (resp) {
                Ctrl.OrganizacionesmuroseccionesCRUD.setScope('elorganizacion', Rs.Usuario.organizacion_id).get();
            }, function (resp) {
                console.log('Error status: ' + resp.status); 
            });

        }

        // Creamos listado de Tipo de novedad
        Ctrl.TipoNovedad = {
            'Parrafo': { Nombre: 'Parrafo', icono: 'fa-align-justify' },
            'Imagen': { Nombre: 'Imagen', icono: 'fa-image' }
        }

        Ctrl.DarFormatoFecha = (fecha) => {
            debugger;
            const dias = fecha.diff(now(), 'days');

            debugger;
            if (dias === 0) {
                return 'Publicado hoy';
            } else {
                if (dias > 30) {
                    return'Publicado hace ' + dias / 30 + ' meses';
                } else {
                    return'Publicado hace ' + dias + ' dias';
                }
            }
        }

        Ctrl.Update = () => {
            alert("Update");
        }
    //FIN DEV ANGÉLICA

    }
]);



