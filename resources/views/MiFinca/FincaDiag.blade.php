<md-dialog class="vh95 w100p mxw550"  layout=column>

	<div layout>
		
		<md-button class="md-icon-button no-margin" aria-label="salir" ng-click="Salir()">
			<md-icon md-font-icon="fa-times fa-lg fa-fw"></md-icon>
		</md-button>
	</div>
	
	<div flex layout=column class="padding-10-20 overflow-y">
	
		<div ng-repeat="F in FincasCRUD.rows ">
								
				<div align="center"><img class="img-finca" src="/../imgs/finca.jpg"  alt="iconFinca" ></div>			
			<md-card-title class="titilo-finca" >				
				<h2>@{{ F.nombre }}</h2>
			</md-card-title>
			  <md-card-content>
				<div class="seccion_texto">
					<label class="texto_title">Zona</label>
					<p >@{{ F.zona_id }}</p>
				</div>
				<div class="seccion_texto" >
					<label class="texto_title">Hectareas</label>
					<p >@{{ F.hectareas }}</p>
				</div >

				<div class="seccion_texto">
					<label class="texto_title">Dirección</label> 
					<p >@{{ F.sitios }}</p>
				</div>

			  </md-card-content>         

		</div>	

		<div class="h120">&nbsp;</div>	

	</div>

</md-dialog>

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
	md-card{
		min-height: 200px;

	}
	.img-finca{
		width: 100px;
		height: 100px;
		border-radius: 500px;
	
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

</style>