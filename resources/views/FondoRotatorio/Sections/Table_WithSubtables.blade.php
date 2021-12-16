<md-card ng-controller="Estadisticas__Table_WithSubtablesCtrl" ng-init="Init(k)">
	<md-card-header layout class="padding">
		<md-card-header-text layout=column>
			<span class="md-title">@{{ S.L.Titulo }}</span>
	    	<span class="md-caption text-bold text-clear">@{{ S.L.Subtitulo }}</span>
		</md-card-header-text>
		<md-input-container md-no-float class="no-margin">
			<md-icon md-font-icon="fa-search"></md-icon>
			<input type="search" placeholder="Buscar..." ng-model="Filter" 
				ng-model-options="{ debounce: 500 }">
		</md-input-container>
		<div class="w10"></div>
		<md-button class="md-raised no-margin" ng-click="Download()">Descargar</md-button>
	</md-card-header>

	<md-card-content class="no-padding table-basic">
		<md-table-container>
			<table md-table class="md-table-short">
				<thead md-head md-order="OrderBy">
					<tr md-row>
						<th></th>
						<th md-column ng-repeat="(k,H) in S.L.data.Headers" md-order-by="@{{k}}">@{{ ::H }}</th>
					</tr>
				</thead>
				<tbody md-body>
					<tr md-row ng-repeat="(k,R) in S.L.data.Rows | orderBy: OrderBy" class="md-row-hover md-pointer" 
						ng-style="{color: S.L.data.RowOpts[k].color, background: S.L.data.RowOpts[k].background}">
						<td md-cell class="md-cell-compress">
							<md-button class="no-margin" ng-class="B.Class" aria-label="i" ng-repeat="B in S.L.data.Buttons" 
								ng-href="@{{ GetUrl(B) }}" ng-click="Button(B, R, $event)">
								<md-tooltip>@{{ B.Name }}</md-tooltip>
								<md-icon md-font-icon="@{{B.Icon}}"></md-icon>
							</md-button>
						</td>
						<td md-cell ng-repeat="(k,C) in ::R" class="md-cell-compress" style="color: inherit">@{{ ::C }}</td>
					</tr>
				</tbody>
			</table>
		</md-table-container>

	</md-card-content>

	<md-card-actions layout>
		<span flex></span>
		<span class="md-subhead"><b>Total</b> @{{ S.L.data.Rows.length }}</span>
		<span class="w20"></span>
	</md-card-actions>

</md-card>