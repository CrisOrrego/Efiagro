<div id="GestionOrganizaciones" ng-controller="OrganizacionesCtrl" flex layout=column>

    <div layout=column class="padding-10-20">
        <div layout="center">
            <div flex="">
                <div class="mi_Organizacion" align="left">
                    <div align="center" class="content_nombre_organizacion">
                        <img id="logo_perfil" class="img-organizacion" src="/../files/img_perfil_organizacion//@{{ Organizacion.id }}.jpg" alt="iconOrganizacion">
                        <md-button ng-if="perfil_id != 4" class="md-icon-button pointer button-container">
                                    <md-icon md-font-icon="fas fa-camera-retro" ng-click="cargarImagen()"></md-icon>
                        </md-button>
                        <h2>@{{ Organizacion . nombre }}</h2>
                        {{-- <h4 class="openOrganigrama pointer" ng-click="abrirOrganigrama(O)">
                            Ver Organigrama
                        </h4> --}}
                    </div>

                </div>
                <br>
                <div class="content_organizacion ">
                    <md-card-content>

                        <div class="seccion_texto">
                            <label class="texto_title">NIT</label>
                            <p>@{{ Organizacion . nit }}</p>
                        </div>

                        <div class="seccion_texto">
                            <label class="texto_title">Dirección</label>
                            <p>@{{ Organizacion . direccion }}</p>
                        </div>

                        <div class="seccion_texto">
                            <label class="texto_title">Teléfono</label>
                            <p>@{{ Organizacion . telefono }}</p>
                        </div>

                        <div class="seccion_texto">
                            <label class="texto_title">Correo</label>
                            <p>@{{ Organizacion . correo }}</p>
                        </div>

                        <div class="seccion_texto">
                            <label class="texto_title">Asociados</label>
                            <p>@{{ Organizacion . total_asociados }}</p>
                        </div>
                        {{-- <div class="seccion_texto">
									<label class="texto_title">Latitud</label> 
									<p >@{{ Organizacion.latitud }}</p>
								</div>
								<div class="seccion_texto">
									<label class="texto_title">Longitud</label> 
									<p >@{{ Organizacion.longitud }}</p>
								</div> --}}

                    </md-card-content>
                </div>
            </div>

             <!--INICIO DEV ANGÉLICA -- Agrega espacio para hacer publicaciones-->
             <div flex="60">
                <div ng-if="perfil_id != 4" layout class="seccion_content" magin-bottom>
                        <md-input-container flex class="md-block" no-margin>
                            <h4 class="openOrganigrama pointer" ng-click="nuevoArticuloMuro()">
                                Agregue novedad...
                            </h4>                        
                        </md-input-container>
                </div>
                <!--FIN DEV ANGÉLICA-->

                <br>
                 <div layout style="margin-bottom:15px;" class="seccion_content" ng-repeat="M in OrganizacionesmuroseccionesCRUD.rows" magin-bottom>
                    <md-content layout-padding magin-bottom flex>
                        <div layout="row">
                            <!--
                            <label class="texto_title">@{{M.usuario.nombre}} - @{{ DarFormatoFecha(M.created_at) }} </label>
                            -->
                            <label class="texto_title">@{{M.usuario.nombre}} - @{{ M.created_at | date:'yyyy-MM-dd' }}  @{{ Darformatofecha(M.created_at) }} </label>
                        </div>

                        <!--Para dar formato al contenido-->
                        <div display:flex layout="row">
                            <p ng-bind-html="M.contenido"></p>
                        </div>

                        <div layout="row">
                            <a href="@{{M.url}}" target="_blank">  @{{ M.url }} </a>
                        </div>

                        <div layout="row" ng-if="M.ruta.length>0">
                            <img class="vistaNovedades" src="/../@{{ M.ruta }}"
                            style="width: 540px; height: 300px;" alt="iconOrganizacion">

                        </div>

                    </md-content>

               

                </div>
            </div>

        </div>
        

    </div>



</div>


<style>
    /* Botones de entradas de estilos utilizados en páginas de descripción de películas.*/

    .button-container{
        position: absolute;
        top:  208px;
        left: 206px;
        background-color: #E0DFCA;
    }

    .button-container md-buttom{
        position: absolute;
        bottom:4em;
        right:4em;
        border-radius:1.5em;
        color:white;
        text-transform:uppercase;
        padding:1em 1.5em;
    }
</style>

<style type="text/css">
    md-card {
        min-height: 200px;

    }

    .content_nombre_organizacion,
    .content_organizacion {
        background-color: aliceblue;
        width: 300px;
        margin: 0;
        padding: 10px;
        border-radius: 10px;


    }

    .img-organizacion {
        width: 130px;
        height: 130px;
        border-radius: 500px;
        margin: 20px;
        padding: 0;
    }

    .seccion_content {
        background-color: aliceblue;
        width: 600px;
        margin: 0;
        padding: 10px;
        border-radius: 10px;

    }

    .openOrganigrama {
        color: green;


    }


    .seccion_organizacion {
        transform: scale(0.95);
        transition: all 0.3s;

    }


    .titilo-organizacion {
        text-align: center;
    }

    .seccion_organizacion:hover {
        transform: scale(1);
    }

    .seccion_texto {
        white-space: normal;
        word-wrap: break-word;
    }

    .texto_title {
        /* text-align: center;
  height: 40px; */
        color: rgb(199, 196, 196);
        /* font-size: 1.2rem;
  text-shadow: 0 0 5px black; */
    }

</style>
