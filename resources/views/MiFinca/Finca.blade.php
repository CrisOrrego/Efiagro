<div id="MiFinca" ng-controller="FincasCtrl" flex layout=column>
	
			{{-- <div layout class="padding-0-10" layout-align="center center">
				<div class="md-title">Fincas</div>
				<md-input-container class="no-margin md-icon-float" md-no-float>
					<md-icon md-font-icon="fa-search fa-fw"></md-icon>
					<input type="text" ng-model="filterFincas" placeholder="Buscar...">
				</md-input-container>
				<span flex></span>	
			</div> --}}
	

			{{-- <div class='md-padding' layout="row"  layout-wrap> --}}
				{{-- <md-card ng-repeat="F in FincasCRUD.rows | filter:filterFincas" class="seccion_finca" flex-sm="25" flex-gt-sm="30" flex="100">
					
						<div align="center"><img class="img-finca" src="/../imgs/finca.jpg"  alt="iconFinca" ></div>			
					<md-card-title class="titilo-finca" >				
						<h2>@{{ F.nombre }}</h2>
					</md-card-title>
			  							  
					  <md-button class="md-raised md-primary" aria-label="Ver" ng-click="abrirFinca()">
						<md-icon md-font-icon="open_with"></md-icon>Ver detalles
					</md-button> --}}
				{{-- </md-card> --}}
			
			{{-- </div> --}}


			<div align="center">
				<md-card class="content"  >
				
				<md-card-title class="titilo-finca" >				
					
				</md-card-title>	
				<md-content class="md-padding">
					
					<md-card-title class="titilo-finca" >				
					
					</md-card-title>
					<md-nav-bar
					  md-no-ink-bar="disableInkBar"
					  md-selected-nav-item="currentNavItem"
					  nav-bar-aria-label="navigation links">
					  <md-nav-item md-nav-click="abrirFinca()" name="mi-finca">
						Mis Fincas
					  </md-nav-item>
					  <md-nav-item md-nav-click="pagFinca('lotes')" name="lotes">
						Lotes
					  </md-nav-item>
					  <md-nav-item md-nav-click="pagFinca('eventos')" name="eventos">
						Eventos
					  </md-nav-item>
					  <md-nav-item md-nav-click="pagFinca('mi-organizacion')" name="mi-organizacion">
						Mi Organización
					  </md-nav-item>
					  
					</md-nav-bar>
					
					
				  </md-content>
			  
			
			  
			  </md-card>
			</div>
			  <!--cerrar contenedor principal-->


			
		  
</div>


<style type="text/css">
	

	.seccion_finca{
		transform: scale(0.95);
		transition: all 0.3s;
		
	}
	.titilo-finca{
		text-align: center;
	}

	.seccion_finca:hover{
		transform: scale(1)	;
	}
	/* md-card{
		min-height: 200px;

	} */
	.content{
		background-image: url("/../imgs/finca.jpg");
		width: 80%;
		min-height: 200px;
				
	}
	.img-finca{
		width:100;
		height: 100%;
		/* border-radius: 500px; */
	


	}
	.seccion_texto{
		white-space:normal;
		word-wrap: break-word;
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