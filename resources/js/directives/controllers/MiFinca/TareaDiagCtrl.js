angular.module('TareaDiagCtrl', [])
.controller('TareaDiagCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog', 'Tarea', 
	function($scope, $rootScope, $http, $injector, $mdDialog, Tarea) {

		console.info('TareaDiagCtrl');
		var Ctrl = $scope;
		var Rs = $rootScope;

		Ctrl.Salir = $mdDialog.cancel;
		Ctrl.Tarea = Tarea;
		
		
	}
]);