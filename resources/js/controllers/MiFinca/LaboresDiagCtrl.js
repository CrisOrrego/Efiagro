angular.module('LaboresDiagCtrl', [])
.controller('LaboresDiagCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog', 'Tarea', 
	function($scope, $rootScope, $http, $injector, $mdDialog, Tarea) {

		console.info('LaboresDiagCtrl');
		var Ctrl = $scope;
		var Rs = $rootScope;

		Ctrl.Salir = $mdDialog.cancel;
		Ctrl.Tarea = Tarea;
		
		
	}
]);