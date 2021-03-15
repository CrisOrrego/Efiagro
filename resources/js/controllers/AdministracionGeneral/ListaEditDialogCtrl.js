//INICIO DEV ANGÉLICA
angular.module('ListaEditDialogCtrl', [])
.controller('ListaEditDialogCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog', 'Lista',
	function($scope, $rootScope, $http, $injector, $mdDialog, Lista) {

		console.info('ListaEditDialogCtrl');
		var Ctrl = $scope;
		var Rs = $rootScope;


		// debugger;
		Ctrl.Cancel = $mdDialog.cancel;
		Ctrl.Lista = angular.copy(Lista);
		console.log(Ctrl.Lista);
		Ctrl.url = '';
		Ctrl.Hide = $mdDialog.hide;
		//Ctrl.Autoincremental = false;

		/*Ctrl.ListaCRUD = $injector.get('CRUD').config({ 
			base_url: '/api/lista/lista',
			limit: 1000,
			add_append: 'refresh',
		});*/

		Ctrl.addListadetalle = () => {
			if(!Ctrl.Lista.listadetalle || Ctrl.Lista.listadetalle.length===0 || Ctrl.Lista.listadetalle [Ctrl.Lista.listadetalle.length-1].descripcion.length>0){
				Ctrl.Lista.listadetalle.push({
					id: -1,
					lista_id: Ctrl.Lista.id,
					codigo: Ctrl.Autoincremental ? Ctrl.Lista.listadetalle?.length+1: '',
					descripcion: '',
					op1: '',
					op2: '',
					op3: '',
					op4: '',
					op5: '',
				})
				
			}
		}

		Ctrl.getLista = () => {
			$http.get ('api/lista/lista/'+ Ctrl.Lista.id, {}).then((r)=>{
				console.log(r);
				Ctrl.Lista = r.data;
				Ctrl.Autoincremental = Ctrl.Lista.autoincremental ===1 ; 
				Ctrl.addListadetalle();
			});
		}

		Ctrl.getLista();

		Ctrl.guardarLista = () => {
			$http.post('api/lista/actualizar', {Lista: Ctrl.Lista}).then((r)=>{
				Ctrl.Lista = r.data;
				console.log(Ctrl.Lista);
			})
		}

		
		Ctrl.eliminarLista = (L) => {
			Rs.confirmDelete({
				Title: '¿Eliminar la Sección?',
			}).then(R => {
				if(!R) return;
				Ctrl.ListaCRUD.delete(L);
			});
		}


	}

 
]);

//FIN DEV ANGÉLICA