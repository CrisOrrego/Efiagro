angular.module("FincasCtrl", []).controller("FincasCtrl", [
    "$scope",
    "$rootScope",
    "$http",
    "$injector",
    "$mdDialog",
    function($scope, $rootScope, $http, $injector, $mdDialog) {
        console.info("FincasCtrl");
        var Ctrl = $scope;
        var Rs = $rootScope;

        Ctrl.Salir = $mdDialog.cancel;

        Ctrl.FincasCRUD = $injector.get("CRUD").config({
            base_url: "/api/fincas/fincas",
            limit: 1000,
            add_append: "refresh",
            order_by: ["-created_at"]
        });

        Ctrl.getFinca = () => {
            Ctrl.FincasCRUD.setScope('id', Rs.Usuario.finca_id);
            Ctrl.FincasCRUD.get().then(() => {
                Ctrl.Finca = Ctrl.FincasCRUD.rows[0];
                //Ctrl.editarFinca(Ctrl.FincasCRUD.rows[0]);
            });
        };

        Ctrl.getFinca();

        Ctrl.nuevaFinca = () => {
            Ctrl.FincasCRUD.dialog({
                Flex: 10,
                Title: "Crear Finca",

                Confirm: { Text: "Crear Finca" }
            }).then(r => {
                if (!r) return;
                Ctrl.FincasCRUD.add(r);
            });
        };

        Ctrl.editarFinca = F => {
            Ctrl.FincasCRUD.dialog(F, {
                title: "Editar Finca" + F.nombre
            }).then(r => {
                if (r == "DELETE") return Ctrl.FincasCRUD.delete(F);
                Ctrl.FincasCRUD.update(r).then(() => {
                    Rs.showToast("Finca actualizada");
                });
            });
        };

        Ctrl.eliminarFinca = (F) => {
            Rs.confirmDelete({
                Title: "¿Eliminar Finca #" +F.id+ "?",
            }).then(d => {
                if (!d) return;
                Ctrl.FincasCRUD.delete(F);
            });
        };

        // $http.post("api/fincas/obtener", {}).then(r => {
        //     Ctrl.Fincas = r.data;
        //     Ctrl.abrirFinca(Ctrl.Fincas[3]); //FIX
        // });

        Ctrl.abrirFinca = (F) => {
            $mdDialog.show({
                templateUrl: "Frag/MiFinca.FincaDiag",
                controller: "FincaDiagCtrl",
                locals: { Finca: F },
                fullscreen: false,
            });
        };


        //Prueba de Lista
        $http.post('api/main/obtener-lista', { Lista: 'Departamentos', op1: 'COL' }).then(r => {
            console.log(r.data);
        });


 // LOTES
 Ctrl.LotesCRUD = $injector.get("CRUD").config({
    base_url: "/api/lotes/lotes",
    limit: 1000,
    add_append: "refresh",
    order_by: ["-created_at"]
});

Ctrl.getLotes = () => {
    Ctrl.LotesCRUD.get().then(() => {
        //Ctrl.editarLote(Ctrl.LotesCRUD.rows[0]);
    });
};

Ctrl.getLotes();

// //Prueba de Mapa
// $http.post('map.html').then(r => {
//     Ctrl.mapa = r.data;
// });


Ctrl.nuevaLote = () => {
    Ctrl.LotesCRUD.dialog({
        Flex: 10,
        Title: "Crear Lote",

        Confirm: { Text: "Crear Lote" }
    }).then(r => {
        if (!r) return;
        Ctrl.LotesCRUD.add(r);
    });
};

Ctrl.editarLote = L => {
    Ctrl.LotesCRUD.dialog(L, {
        title: "Editar Lote" + L.id
    }).then(r => {
        if (r == "DELETE") return Ctrl.LotesCRUD.delete(L);
        Ctrl.LotesCRUD.update(r).then(() => {
            Rs.showToast("Lote actualizado");
        });
    });
};

Ctrl.eliminarLote = L => {
    Rs.confirmDelete({
        Title: "¿Eliminar Lote #" + L.id + "?"
    }).then(d => {
        if (!d) return;
        Ctrl.LotesCRUD.delete(L);
    });
};

//    Ctrl.abrirLote = (L) => {
//         $mdDialog.show({
//             templateUrl: "Frag/MiFinca.FincaDiag",
//             controller: "FincaDiagCtrl",
//             locals: { Lote: L },
//             fullscreen: false,
//         });
//     };

// TAREAS

Ctrl.TareasCRUD = $injector.get("CRUD").config({
    base_url: "/api/fincas/fincas",
    limit: 1000,
    add_append: "refresh",
    order_by: ["-created_at"]
});

Ctrl.getTareas = () => {
    Ctrl.TareasCRUD.get().then(() => {
        //Ctrl.editarTarea(Ctrl.TareasCRUD.rows[0]);
    });
};

Ctrl.getTareas();

Ctrl.nuevaTarea = () => {
    Ctrl.TareasCRUD.dialog({
        Flex: 10,
        Title: "Crear Tarea",

        Confirm: { Text: "Crear Tarea" }
    }).then(r => {
        if (!r) return;
        Ctrl.TareasCRUD.add(r);
    });
};

Ctrl.editarTarea = (T) => {
    Ctrl.TareasCRUD.dialog(T, {
        title: "Editar Tarea" + T.id
    }).then(r => {
        if (r == "DELETE") return Ctrl.TareasCRUD.delete(T);
        Ctrl.TareasCRUD.update(r).then(() => {
            Rs.showToast("Tarea actualizado");
        });
    });
};

Ctrl.eliminarTarea = (T) => {
    Rs.confirmDelete({
        Title: "¿Eliminar Tarea #" + T.id + "?"
    }).then(d => {
        if (!d) return;
        Ctrl.TareasCRUD.delete(T);
    });
};
Ctrl.abrirTarea = (T) => {
    $mdDialog.show({
        templateUrl: "Frag/MiFinca.TareaDiag",
        controller: "TareaDiagCtrl",
        locals: { Tarea: T },
        fullscreen: false
    });
};
}
]);
