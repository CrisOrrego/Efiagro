angular.module('App', [

	'ui.router',

	'ngStorage',
	'ngMaterial',
	'ngSanitize',

	'md.data.table',
	
	//'ngFileUpload',
	//'angular-loading-bar',
	//'angularResizable',
	//'ui.utils.masks',
	//'as.sortable',
	//'ngCsv',
	//'angular-img-cropper',
	//'indexedDB',
	'CRUD',
	'CRUDDialogCtrl',
	'ConfirmDeleteCtrl',
	'Filters',

	'appRoutes',
	'appConfig',
	'appFunctions',

	'LoginCtrl',
	'MainCtrl',
	'HomeCtrl',

	'MiTecnicoAmigoCtrl',
	'ArticuloDiagCtrl',

	'UsuariosCtrl',
	'ArticulosCtrl',
]);