<div flex id="Home" ng-controller="HomeCtrl" layout=column>
	
	<div class="h40 bg-primary" layout layout-align="center center"
		style="padding-left: 30px">
		<div ng-click="navegarHome()" >PACO</div>
		<div class="w30"></div>
		<md-select ng-model="Usuario.organizacion_id" class="no-margin" aria-label="Organizacion">
			<md-option ng-value="O.id" ng-repeat="O in Usuario.organizaciones">@{{ O.nombre }}</md-option>
		</md-select>
		<md-select ng-model="Usuario.finca_id" class="no-margin" aria-label="Finca">
			<md-option ng-value="F.id" ng-repeat="F in Usuario.fincas">@{{ F.nombre }}</md-option>
		</md-select>

		<span flex></span>
		<div>@{{ Usuario.nombre }} </div>
		<md-button class="md-icon-button" ng-click="Logout()">
			<md-icon md-font-icon="fa-power-off fa-lg"></md-icon>
			<md-tooltip>Cerrar Sesion</md-tooltip>
		</md-button>
	</div>

	<div flex ui-view layout=column class="overflow-y">
		<div flex layout layout-align="space-around center" layout-wrap>
			<a ng-repeat="S in Secciones" href="#/Home/@{{ S[0].seccion_slug }}/@{{ S[0].subseccion_slug }}"
				class="seccion_icono no-underline" layout=column>
				<div class="seccion_icono_img" flex></div>
				<div class="seccion_icono_texto">@{{ S[0].seccion }}</div>
			</a>
			<div flex=100 class="h50"></div>
		</div>	
	</div>
</div>

<style type="text/css">
	
	.seccion_icono{
		width: 160px;
		height: 200px;
		margin: 20px;
		transform: scale(0.95);
		transition: all 0.3s;
		
	}

	.seccion_icono:hover{
		transform: scale(1)	;
	}

	.seccion_icono_texto{
		text-align: center;
		height: 40px;
		color: white;
		font-size: 1.2rem;
		text-shadow: 0 0 5px black;
	}

	.seccion_icono_img{
		background-color: grey;
		margin: 5px;
		border-radius: 500px;
		background-image: url("imgs/default-section-icon.jpg");
	}

</style>
