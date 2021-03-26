angular.module('App', [

    'ui.router',

    'ngStorage',
    'ngMaterial',
    'ngSanitize',

    'md.data.table',

    'ngFileUpload',
    //'angular-loading-bar',
    //'angularResizable',
    'ui.utils.masks',
    //'as.sortable',
    //'ngCsv',
    'angular-img-cropper',
    //'indexedDB',
    'enterStroke',
    'textAngular',


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
    'LineasProductivasCtrl', // Luigi
    //'MitecnicoAmigoInicioCtrl', // Luigi
    //Inicio Dev Angélica
    'ContactoCtrl',
    'ArticulomuroEditDialogCtrl',
    'ConfiguracionCtrl',
    'ListaEditDialogCtrl',
    //Fin Dev Angélica

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
    'Zonas_ZonaEditorCtrl',
    'LaboresCtrl',
    'LaboresDiagCtrl',
    'LotesCtrl',
    'Labores_LaborEditorCtrl',

    'FondoRotatorio_CreditosCtrl', //CAOH
    'FondoRotatorio_NuevoCreditoDiagCtrl', //CAOH
    'CreditoSrv',

]);
