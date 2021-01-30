angular.module('LoteDiagCtrl', [])
.controller('LoteDiagCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog', 'Lote',
	function($scope, $rootScope, $http, $injector, $mdDialog, Lote) {

		console.info('LoteDiagCtrl');
		var Ctrl = $scope;
		var Rs = $rootScope;

		Ctrl.Salir = $mdDialog.cancel;
		Ctrl.Lote = Lote;
		
	}
]);