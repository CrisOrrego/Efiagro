angular.module('App', [

    'ui.router',

    'ngStorage',
    'ngMaterial',
    'ngSanitize',

    'md.data.table',

    'ngFileUpload',
    //'angular-loading-bar',
    //'angularResizable',
    //'ui.utils.masks',
    //'as.sortable',
    //'ngCsv',
    'angular-img-cropper',
    //'indexedDB',
    'enterStroke',


    'CRUD',
    'CRUDDialogCtrl',
    'ConfirmDeleteCtrl',
    'ImageEditor_DialogCtrl',
    'BasicDialogCtrl',
    'Filters',

    'appRoutes',
    'appConfig',
    'appFunctions',

    'LoginCtrl',
    'MainCtrl',
    'HomeCtrl',

    // Mi tecnico Amigo
    'MiTecnicoAmigoCtrl',
    'ArticulosCtrl',
    'ArticuloDiagCtrl',
    'Articulos_ArticuloEditorCtrl',
    'SolicitudesDetalleCtrl',
    'CasosCtrl', // Luigi
    'Casos_NovedadesCtrl', // Luigi
    //'MitecnicoAmigoInicioCtrl', // Luigi // Se inactiva pq se cambia el modelo de visualizacion

    // Gestion de la Organizacion
    'OrganizacionesCtrl',
    'OrganizacionDiagCtrl',
    //'UsuariosCtrl',
    
    // Mi finca
    'FincasCtrl',
    'FincaDiagCtrl',

    // Administracion General
    'ZonasCtrl',
    'LineasProductivasCtrl', // Luigi
    'ContactoCtrl',
    'LaboresCtrl',
    'UsuariosCtrl', // Luigi
    
    // Pendientes
    'TareaDiagCtrl',
    'PerfilesCtrl', // Luigi

]);