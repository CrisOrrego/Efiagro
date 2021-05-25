<div flex layout=column ng-controller="MiTecnicoAmigoCtrl">

	<div class="div_bienvenida md-title padding-top padding-left">
        ¡Bienvenido!, ¿Cómo le puedo ayudar? 
    </div>
    <div layout=column flex layout-align="start center" class="padding">
            <md-button class="md-raised boton-principal mxw350" ng-click="navegarA('Articulos')">
                Ver los Artículos publicados
            </md-button>
            <md-button class="md-raised boton-principal mxw350" ng-click="crearCaso()">
                Contar una experiencia
            </md-button>
            <md-button class="md-raised boton-principal mxw350" ng-click="navegarA('Solicitudes')">
                Contactar a Técnico Amigo
            </md-button>
        </div>
</div>
<img ng-src="imgs/paco.png" alt="" >

<style type="text/css">
	.boton-principal{
		border-radius: 100px;
		padding: 6px 30px;
		font-size: 1.1em;
		text-shadow: 1px 1px 1px #00000066;
	}
    .div_bienvenida{
        /* color: aliceblue; */
        font-size: 2em;
    }
</style>