<div id="GestionOrganizaciones" ng-controller="OrganizacionesCtrl" flex layout=column>
	
			<div layout class="padding-0-10" layout-align="center center">
				<div class="md-title">Organizaciones</div>
				<md-input-container class="no-margin md-icon-float" md-no-float>
					<md-icon md-font-icon="fa-search fa-fw"></md-icon>
					<input type="text" ng-model="filterOrganizaciones" placeholder="Buscar...">
				</md-input-container>
				<span flex></span>	
			</div>
	

			<div class='md-padding' layout="row"  layout-wrap>
				<md-card ng-repeat="O in OrganizacionesCRUD.rows | filter:filterOrganizaciones" class="seccion_organizacion" flex-sm="25" flex-gt-sm="30" flex="100">
					
						<div align="center"><img class="img-organizacion" src="/../imgs/organizacion1.jpg"  alt="iconOrganizacion" ></div>			
					<md-card-title class="titilo-organizacion" >				
						<h2>@{{ O.nombre }}</h2>
					</md-card-title>
					  
					  <md-button class="md-raised md-primary" aria-label="Ver" ng-click="abrirOrganizacion(O)">
						<md-icon md-font-icon="open_with"></md-icon>Ver detalles
					</md-button>

					
				</md-card>
			
			</div>

			
		  
</div>


<style type="text/css">
	

	.seccion_organizacion{
		transform: scale(0.95);
		transition: all 0.3s;
		
	}
	.titilo-organizacion{
		text-align: center;
	}

	.seccion_organizacion:hover{
		transform: scale(1)	;
	}
	md-card{
		min-height: 200px;

	}
	.img-organizacion{
		width: 100px;
		height: 100px;
		border-radius: 500px;
	}

</style>