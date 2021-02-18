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

    'MiTecnicoAmigoCtrl',
    'ArticuloDiagCtrl',
    'SolicitudesDetalleCtrl',

    'UsuariosCtrl',
    'ArticulosCtrl',
    'Articulos_ArticuloEditorCtrl',
    'CasosCtrl', // Luigi
    'Casos_NovedadesCtrl', // Luigi
    'LineasProductivasCtrl', // Luigi
    //Inicio Dev Angélica
    'ContactoCtrl',
    //Fin Dev Angélica

    'OrganizacionesCtrl',
    'OrganizacionDiagCtrl',

    'FincasCtrl',
    'FincaDiagCtrl',
    'TareaDiagCtrl',

    // 'PerfilesCtrl',
    // Zonas Agroambientales
    'ZonasCtrl',


]);