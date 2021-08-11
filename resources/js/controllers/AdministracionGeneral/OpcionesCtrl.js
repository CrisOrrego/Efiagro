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
      Ctrl.OpcionesCRUD.get().then(() => {
        Ctrl.Opcion = Ctrl.OpcionesCRUD.rows[0]
        //Ctrl.editarLote(Ctrl.LotesCRUD.rows[0]);
      })
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
  },
])
