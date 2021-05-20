angular.module('FondoRotatorio_CreditosCtrl', [])
.controller('FondoRotatorio_CreditosCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog', 
	function($scope, $rootScope, $http, $injector, $mdDialog) {

		console.info('FondoRotatorio_CreditosCtrl');
		var Ctrl = $scope;
		var Rs = $rootScope;
		Ctrl.AsociadosNav = true;
		Ctrl.Asociado = null;
	
		Ctrl.buscarAsociados = (query) => {
			return Rs.http('api/usuario/buscar-usuario', { 'query': query });
		}

		Ctrl.selectAsociado = (Asociado) => {
			Ctrl.Asociado = Asociado;
		}
		
		Ctrl.nuevoCredito = function(){
			$mdDialog.show({
				controller: 'FondoRotatorio_NuevoCreditoDiagCtrl',
				templateUrl: '/Frag/FondoRotatorio.Creditos_NuevoCreditoDiag',
				clickOutsideToClose: false,
				locals: { Asociado: Ctrl.Asociado, myUser: Rs.Usuario, Parent: Ctrl, Simulate: false },
				fullscreen: true,
			}).then(function(Cred) { 
				//Ctrl.ViewCredit(Cred);
				Ctrl.LoadCreditos();
			});
		}


		Ctrl.LoadCreditos = function(){
			$http.post('/api/creditos/get', { asociado_id: Ctrl.Asociado.id }).then(function(res){
				Ctrl.Creditos = res.data;
				Ctrl.CredSel = null;
				//Ctrl.ViewCredit(Ctrl.Creditos[0]); //FIX
			});
		}

		Ctrl.ViewCredit = function(Cred){
			
			if (!angular.isDefined(Cred)) return false;
			$http.get('/api/creditos/?id='+Cred.id).then(function(res){
				Ctrl.CredSel = res.data;
				//Ctrl.NewAbono(); //FIX
			});

		}

		Ctrl.NewAbono = function(ev){
			$mdDialog.show({
				controller: 'FondoRotatorio_Creditos_PayDialogCtrl',
				templateUrl: '/Frag/FondoRotatorio.Creditos_PayDialog',
				clickOutsideToClose: false,
				locals: { CredSel: Ctrl.CredSel, Parent: Ctrl },
				fullscreen: true,
				targetEvent: ev,
			}).then(function() { 
				Ctrl.ViewCredit(Ctrl.CredSel);
			});
		}

		//Testing
		Rs.http('api/usuario/buscar-usuario', { 'query': '1093' }).then(r => {
			Ctrl.Asociado =  r[0];
			Ctrl.LoadCreditos();
			//Ctrl.nuevoCredito();
		});

	}
]);