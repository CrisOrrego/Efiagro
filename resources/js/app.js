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
    'printThis',
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

    'MiTecnicoAmigoCtrl',
    'ArticuloDiagCtrl',
    'SolicitudesDetalleCtrl',

    'UsuariosCtrl',
    'UsuarioFincaCtrl',     // Luigi
    'ArticulosCtrl',
    'Articulos_ArticuloEditorCtrl',
    'CasosCtrl', // Luigi
    'Casos_NovedadesCtrl', // Luigi
    'LineasProductivasCtrl', // Luigi
    //'MitecnicoAmigoInicioCtrl', // Luigi
    
    //Inicio Dev Angélica
    'ContactoCtrl',
    'ArticulomuroEditDialogCtrl',
    'ConfiguracionCtrl',
    'ListaEditDialogCtrl',
    'LotesFincaCtrl',
    'FincasMifincaCtrl',
    //Fin Dev Angélica

    'OrganizacionesCtrl',
    'OrganizacionDiagCtrl',
    'CultivosCtrl',
    'FincasCtrl',
    'FincaDiagCtrl',
    'PerfilesCtrl', // Luigi
    
    // 'PerfilesCtrl',
    // Zonas Agroambientales
    'ZonasCtrl',
    'Zonas_ZonaEditorCtrl',
    'LaboresCtrl',
    'LaboresDiagCtrl',
    'LotesCtrl',
    'LoteDiagCtrl',
    'Labores_LaborEditorCtrl',

    'FondoRotatorio_CreditosCtrl', //CAOH
    'FondoRotatorio_NuevoCreditoDiagCtrl', //CAOH
    'FondoRotatorio_Creditos_PayDialogCtrl', //CAOH
    'FondoRotatorio__Creditos_CreditoDialogCtrl', //CAOH
    'FondoRotatorio__Creditos_ReciboDialogCtrl', //CAOH
    'CreditoSrv', //CAOH
    'FondoRotatorio_ListadoCtrl', //CAOH
    'FondoRotatorio_MisCreditosCtrl' //CAOH

]);
