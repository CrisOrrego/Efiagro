angular.module('OpcionesCtrl', []).controller('OpcionesCtrl', [
  '$scope',
  '$rootScope',
  '$http',
  '$injector',
  '$mdDialog',
  function ($scope, $rootScope, $http, $injector, $mdDialog) {
    var Ctrl = $scope
    var Rs = $rootScope

    Ctrl.Salir = $mdDialog.cancel

    Ctrl.value = 0


    Ctrl.OpcionesCRUD = $injector.get('CRUD').config({
      base_url: '/api/opciones/opciones',
      limit: 1000,
      add_append: 'refresh',
      order_by: ['-created_at'],
      // query_with:['']
    })
  

    Ctrl.getOpciones = () => {
    //  Ctrl.OpcionesCRUD.setScope('id', Rs.Usuario.organizacion_id[1]); //con el setScope estoy haciendo un filtro en la BD para que él nos traiga sólo un registro
      /*Ctrl.OpcionesCRUD.get().then(() => {
        Ctrl.Opcion = Ctrl.OpcionesCRUD.rows[0]
        //Ctrl.editarLote(Ctrl.LotesCRUD.rows[0]);
      })*/
      Rs.http('/api/opciones', {}, Ctrl, 'Opciones');
    }

    Ctrl.getOpciones()

    Ctrl.nuevaOpcion = () => {
      Ctrl.OpcionesCRUD.dialog({
        Flex: 10,
        Title: 'Crear Opcion',

        Confirm: { Text: 'Crear Opcion' },
      }).then((r) => {
        if (!r) return
        Ctrl.OpcionesCRUD.add(r)
        Rs.showToast('Opcion Creada')
      })
    }
    Ctrl.editarOpcion = (Ops) => {
      Ctrl.OpcionesCRUD.dialog(Ops, {
        title: 'Editar Opcion' + Ops.id,
      }).then((r) => {
        if (r == 'DELETE') return Ctrl.OpcionesCRUD.delete(Ops)
        Ctrl.OpcionesCRUD.update(r).then(() => {
          Rs.showToast('Opcion actualizada')
        })
      })
    }
    Ctrl.eliminarOpcion = (Ops) => {
      Rs.confirmDelete({
        Title: '¿Eliminar Lote #' + Ops.id + '?',
      }).then((d) => {
        if (!d) return
        Ctrl.OpcionesCRUD.delete(Ops)
      })
    }

    Rs.actualizarOpcion = ( opcion, valor) => {
      // console.log(opcion, valor, organizacion_id);
      $http.post('api/opciones/actualizaropcion', {
        Dato: {
          usuarioid: Rs.Usuario['id'],
          organizacion: 1,
          opcion: opcion, 
          valor: valor
        }
      }).then( () => {
       alert('Opcion Actualizada')
      
      });
  }

  Ctrl.boolOpcion = () => {

    Ctrl.OpcionesCRUD.dialog({}, {
    //Rs.BasicDialog({
      Flex: 30,
      Title: 'Crear Nueva Lista',
      /*Fields: [
        { Nombre: 'lista',  Value: '', Type: 'textarea', Required: true},
        { Nombre: 'autoincremental', Value: autoincrementals[0], Type: 'simplelist', List: autoincrementals, Required: true }
      ],
      Confirm: { Text: 'Crear Lista' },*/
    }).then(r => {
      if(!r.opcion){
        r.opcion = false;
      }
      Ctrl.OpcionesCRUD.add(r).then(() => {
        Rs.showToast('Lista creada');
      });
      /*if(!r) return;
      var NuevaLista = {
        lista: r.Fields[0].Value,
        autoincremental: r.Fields[1].Value === 'Si' ? 1:0
      };

      Ctrl.OpcionesCRUD.add(NuevaLista);*/
    });

  };
  
    // Validar Organización para cargar opciones
            // Las opciones solo apareceran a usuarios con la organizacion ID 1
            switch( parseInt(Rs.Usuario['organizacion_id']) ) {
              case 1:
                  Ctrl.listOpciones = true;
                  break;           
          }
  },
])