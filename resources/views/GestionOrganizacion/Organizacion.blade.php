<div id="GestionOrganizaciones" ng-controller="OrganizacionesCtrl" flex layout=column>


    <div layout=column class="padding-10-20">
        <div layout="center">
            <div flex="">
                <div class="mi_Organizacion" align="left">

                    <div align="center" class="content_nombre_organizacion ">
                        <img class="img-organizacion" src="/../imgs/organizacion1.jpg" alt="iconOrganizacion">
                        <h2>@{{ Organizacion . nombre }}</h2>

                        <h4 class="openOrganigrama pointer" ng-click="abrirOrganigrama(O)">
                            Ver Organigrama
                        </h4>


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

            <div flex="60">
                <div class="seccion_content ">
                    <md-input-container class="md-block">
                        <label>Agregue novedad</label>
                        <textarea ng-model="" md-maxlength="150" rows="1" md-select-on-focus></textarea>

                </div>
                <br>
                <div class="seccion_content ">
                    <md-content layout-padding>

                        <div layout="row">
                            <div layout="column" flex>
                                <h2>Multiple Groups</h2>
                                <p>
                                    Panels can be added to multiple groups. The <code>groupName</code>
                                    parameter in the panel configuration can be a string or an array of
                                    strings. This allows for the functionality or constraints of multiple
                                    groups to apply to each created panel.
                                </p>
                                <p>
                                    To give an example, the menus within the toolbar above have been added
                                    to the <strong>toolbar</strong> and <strong>menus</strong> groups.
                                    The menus to the right have been added to the <strong>menus</strong>
                                    group as well. The maximum number of open panels within the
                                    <strong>toolbar</strong> group is <strong>2</strong>. Within the
                                    <strong>menus</strong> group it is <strong>3</strong>. Opening the
                                    menus to the right and more than one in the toolbar will result in
                                    the first opened panel to the right to close.
                                </p>
                            </div>

                        </div>
                    </md-content>
                </div>
                <br>
                <div class="seccion_content ">

                    <md-content layout-padding>
                        <label class="texto_title">Miguel Herrera - Hace 1 dia </label>
                        <img class="vistaNovedades" src="/../imgs/vistaorganizacion_novedades.jpg"
                            style="width: 560px; height: 300px;" alt="iconOrganizacion">

                    </md-content>

                </div>
            </div>

        </div>
        <div class="h120">&nbsp;</div>

    </div>



</div>


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
