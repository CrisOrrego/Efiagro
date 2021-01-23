
<md-dialog class="vh95 w100p mxw550"  layout=column>

	<div layout>
		
		<md-button class="md-icon-button no-margin" aria-label="salir" ng-click="Salir()">
			<md-icon md-font-icon="fa-times fa-lg fa-fw"></md-icon>
		</md-button>
	</div>
	
	<div flex layout=column class="padding-10-20 overflow-y">
	
		<div ng-repeat="O in OrganizacionesCRUD.rows ">
            
            <div align="center"><img class="img-organizacion" src="/../imgs/organizacion1.jpg"  alt="iconOrganizacion" ></div>			
					<md-card-title class="titilo-organizacion" >				
						<h2>@{{ O.nombre }}</h2>
					</md-card-title>

					<md-card-content>
						<script>
							var map;
							

							function initMap() {
								map = new google.maps.Map(document.getElementById('map'), {
									center: {lat: 4.814922, lng: -75.707020},
									mapTypeId: 'satellite',
									zoom: 18,
									disableDefaultUI: true
								});
								var marker = new google.maps.Marker({position: {lat: 4.814922, lng: -75.707020}, map: map})
							}
						</script>
						<script async defer
							src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjjB89k3h2YU7w4NTNQ6euTDtuQ8IeH7g&callback=initMap">
						</script>
						<div id="map" style="width: 100%;height: 242px;overflow: hidden;"></div>
						
					</md-card-content>


			  		<md-card-content>
				
						<div class="seccion_texto" >
							<label class="texto_title">NIT</label>
							<p >@{{ O.nit }}</p>
						</div >
						
						<div class="seccion_texto">
							<label class="texto_title">Dirección</label> 
							<p >@{{ O.direccion }}</p>
						</div>

						<div class="seccion_texto">
							<label class="texto_title">Teléfono</label>
							<p >@{{ O.telefono }}</p>
						</div>

						<div class="seccion_texto">
							<label class="texto_title">Correo</label>
							<p >@{{ O.correo }}</p>
						</div>

						<div class="seccion_texto">
							<label class="texto_title">Asociados</label> 
							<p >@{{ O.total_asociados }}</p>
						</div>
						<div class="seccion_texto">
							<label class="texto_title">Latitud</label> 
							<p >@{{ O.latitud }}</p>
						</div>
						<div class="seccion_texto">
							<label class="texto_title">Longitud</label> 
							<p >@{{ O.longitud }}</p>
						</div>
					
					  </md-card-content           

		</div>	

		<div class="h120">&nbsp;</div>	

	</div>

	

</md-dialog>

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