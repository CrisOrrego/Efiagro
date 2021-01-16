<div id="GestionOrganizaciones" ng-controller="OrganizacionesCtrl" flex layout=column>
	
			<div layout class="padding-0-10" layout-align="center center">
				<div class="md-title">Organizaciones</div>
				<md-input-container class="no-margin md-icon-float" md-no-float>
					<md-icon md-font-icon="fa-search fa-fw"></md-icon>
					<input type="text" ng-model="filterOrganizaciones" placeholder="Buscar...">
				</md-input-container>
				<span flex></span>	
			</div>
	

			<div class="md-padding "  layout="row">
				<md-card ng-repeat="O in OrganizacionesCRUD.rows | filter:filterOrganizaciones" class="seccion_organizacion">
					<img src="/../imgs/organizacion1.jpg"  alt="iconOrganizacion">
					<md-card-title >				
						<span class="md-headline">@{{ O.nombre }}</span>
					</md-card-title>
			  
			  		<md-card-content >
				
						<span class="seccion_texto" >
							<label class="texto_title">NIT</label>
							<span class="md-subhead">@{{ O.nit }}</span>
						</span >

						<span class="seccion_texto">
							<label class="texto_title">Dirección</label> 
							<span class="md-subhead">@{{ O.direccion }}</span>
						</span>

						<span class="seccion_texto">
							<label class="texto_title">Teléfono</label>
							<span class="md-subhead">@{{ O.telefono }}</span>
						</span>

						<span class="seccion_texto">
							<label class="texto_title">Correo</label>
							<span class="md-subhead">@{{ O.correo }}</span>
						</span>

						<span class="seccion_texto">
							<label class="texto_title">Asociados</label> 
							<span class="md-subhead">@{{ O.total_asociados }}</span>
						</span>
					
					  </md-card-content>
					 
				</md-card>
			
			</div>
		  
</div>


<style type="text/css">
	
	.seccion_organizacion{
		transform: scale(0.95);
		transition: all 0.3s;
		
	}

	.seccion_organizacion:hover{
		transform: scale(1)	;
	}
	.seccion_texto{
		white-space:pre-line;

	}

	.texto_title{
		/* text-align: center;
		height: 40px; */
		color: rgb(199, 196, 196);
		/* font-size: 1.2rem;
		text-shadow: 0 0 5px black; */
		
		
	}

	.organizacion_icono{
		background-color: grey;
		margin: 5px;
		border-radius: 1000px;
		background-image: url("/../imgs/organizacion1.jpg");
	}

</style>