<div id="Tareas" ng-controller="FincasCtrl" flex layout=column>

    <div ng-cloak>
        <md-content class="encabezado">
            <div layout>

                <md-button class="md-icon-button no-margin" aria-label="salir" ng-click="Salir()">
                    <md-icon md-font-icon="fa-times fa-lg fa-fw"></md-icon>
                </md-button>
            </div>

            <md-card >
                    <md-content class="md-padding">

                        <div layout="row" >
                           
                                <div class="seccion_texto">
                                    <label class="texto_title">#</label>
                                    <p>@{{ T . id }}</p>
                                </div>
                                <div class="seccion_texto">
                                    <label class="texto_title">Tarea</label>
                                    <p>@{{ T . nombre_tarea }}</p>
                                </div>

                                <div class="seccion_texto">
                                    <label class="texto_title">Semana</label>
                                    <p>@{{ T . semana }}</p>
                                </div>
                                <div class="seccion_texto">
                                    <label class="texto_title">Estado</label>
                                    <p>@{{ T . estado }}</p>
                                </div>

                            </div>

                        </div>
                    </md-content>
                </md-card>

            <!--cerrar contenedor principal-->
    </div>


    <style type="text/css">
        .seccion_lotes {
            transform: scale(0.95);
            transition: all 0.3s;


        }

        .seccion_lotes:hover {
            transform: scale(1);
        }

        .seccion_lotes {
            width: 600px;
            padding: 10px;

        }

        /* .lotes_content{
        display: block;
    } */

        md-card {
            min-height: 0%;
            background-color: rgb(255, 248, 240);
        }

        .titilo-finca {
            text-align: center;
            white-space: normal;
            word-wrap: break-word;
            color: rgb(255, 255, 255);

        }

        .titulo_navegacion {
            color: rgb(255, 255, 255);

        }

        /* .seccion_finca:hover {
        transform: scale(1);
    } */
        /* .encabezado {
            background-image: url("/../imgs/finca.jpg");

        } */

        .seccion_texto {
            white-space: normal;
            word-wrap: break-word;
        }

        .texto_title {
            color: rgb(199, 196, 196);
        }

        .texto_tarea {
            color: rgba(247, 20, 20, 0.815);
        }

        .img-lote {
            width: 50px;
            height: 50px;
            /* border-radius: 500px; */
        }

    </style>
