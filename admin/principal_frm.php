<div class='row'>
	<div class='col-md-12'>
		<form id='divPrincipalFrm' class='form-horizontal'>
			<div class='form-group'>
				<label class='col-lg-2 col-xs-12 control-label' for='pPrincipal'>Id. Principal</label>
				<div class='col-lg-4 col-xs-12'>
					<input id='pPrincipal' readonly maxlength='11' type='text'
						class='form-control integer' />
				</div>
				<label class='col-lg-2 col-xs-12 control-label' for='pAnexo01'>pAnexo01</label>
				<div class='col-lg-4 col-xs-12'>
					<!--  class='typeahead-field' -->
					<select id='pAnexo01' class='form-control'></select>
					<!-- input id='pAnexo01' type='text'
						class='form-control typeahead tt-query' spellcheck='false'
						autocomplete='off' / -->
				</div>
			</div>
			<div class='form-group'>
				<label class='col-lg-2 control-label' for='cNombre'>Nombre</label>
				<div class='col-lg-6 col-xs-12'>
					<input id='cNombre' maxlength='40' type='text'
						class='form-control upper alfabetico' />
				</div>
			</div>
			<div class='form-group'>
				<label class='col-lg-2 control-label' for='cDescripcion'>Descripción</label>
				<div class='col-lg-10 col-xs-12'>
					<textarea id='cDescripcion' class="form-control" rows="5"></textarea>
				</div>
			</div>
			<div class='form-group'>
				<label class='col-lg-2 control-label' for='cExtendido'>Extendido</label>
				<div class='col-lg-10 col-xs-12'>
					<textarea id='cExtendido' class="form-control" rows="5"></textarea>
				</div>
			</div>
			<div class='form-group'>
				<label class='col-lg-2 col-xs-12 control-label' for='cTpVarios01'>Varios</label>
				<div class='col-lg-2 col-xs-12'>
					<select id='cTpVarios01' class='form-control'></select>
				</div>
				<label class='col-lg-2 col-xs-12 control-label' for='cProvincia'>Provincia</label>
				<div class='col-lg-2 col-xs-12'>
					<select id='cProvincia' class='form-control'></select>
				</div>
			</div>
			<div class='form-group'>
				<label class='col-lg-2 col-xs-12 control-label' for='dFecha'>Fecha</label>
				<div class='col-lg-2 col-xs-12'>
					<input id='dFecha' type='text' class='form-control' />
				</div>
				<label class='col-lg-2 col-xs-12 control-label' for='cMarca'>Marca</label>
				<div class='col-lg-2 col-xs-12'>
					<select id='cMarca' class='form-control'></select>
				</div>
				<label class='col-lg-2 col-xs-12 control-label' for='nFactor'>Factor</label>
				<div class='col-lg-2 col-xs-12'>
					<input id='nFactor' maxlength='10' type='text'
						class='form-control integer' />
				</div>
			</div>
			<div class='form-group'>
				<label class='col-md-2 col-xs-12 control-label' for='cTipo'>Tipo</label>
				<div class='col-md-2 col-xs-12'>
					<select id='cTipo' class='form-control'></select>
				</div>
				<label class='col-md-2 col-xs-12 control-label' for='nValor'>Valor</label>
				<div class='col-md-2 col-xs-12'>
					<input id='nValor'  type='text'
						class='form-control integer' />
				</div>
				<label class='col-md-2 col-xs-12 control-label' for='nStock'>Stock</label>
				<div class='col-md-2 col-xs-12'>
					<input id='nStock'  type='text'
						class='form-control integer' />
				</div>
			</div>

			<div class='form-group'>
				<label class='col-md-2 col-xs-12 control-label' for='bHabilitado'>Habilitado</label>
				<div class='col-md-2 col-xs-12'>
					<input id='bHabilitado' class='form-control' type='checkbox' value='1'/>
				</div>
			</div>

			<div class='form-group'>
				<div class='col-lg-2 col-xs-12'></div>
				<div class='col-lg-1 col-xs-2'>
					<div class="btn-group btn-group-toggle" data-toggle="buttons">
						<label class='btn btn-default atributo' >Novedad
							<input id='atributo' class='form-control' type='checkbox' value='Nuevo' autocomplete='off'/>
						</label>
					</div>
				</div>
				<div class='col-lg-1 col-xs-2'>
					<div class="btn-group btn-group-toggle" data-toggle="buttons">
						<label class='btn btn-default atributo' >Mas vendido
							<input id='atributo' class='form-control' type='checkbox' value='MasVendido' autocomplete='off'/>
						</label>
					</div>
				</div>
				<div class='col-lg-1 col-xs-2'>
					<div class="btn-group btn-group-toggle" data-toggle="buttons">
						<label class='btn btn-default atributo' >Ofertas
							<input id='atributo' class='form-control' type='checkbox' value='OfertasDia' autocomplete='off'/>
						</label>
					</div>
				</div>
				<div class='col-lg-1 col-xs-2'>
					<div class="btn-group btn-group-toggle" data-toggle="buttons">
						<label class='btn btn-default atributo' >Promoción
							<input id='atributo' class='form-control' type='checkbox' value='Descuento' autocomplete='off'/>
						</label>
					</div>
				</div>
			</div>
			<div class='form-group'>
				<div class='col-lg-6 col-xs-12'></div>
				<div class='col-lg-2 col-xs-2'>
					<button type="button" onclick="oPrincipal.nuevo(this);"
						class="btn btn-success">&nbsp;&nbsp;&nbsp; Nuevo
						&nbsp;&nbsp;&nbsp;</button>
				</div>
				<div class='col-lg-2 col-xs-3'>
					<button type="button" onclick="oPrincipal.grabar(this);"
						class="btn btn-primary">&nbsp;&nbsp;&nbsp; Grabar
						&nbsp;&nbsp;&nbsp;</button>
				</div>
				<div class='col-lg-2 col-xs-2'>
					<button type="button" onclick="oPrincipal.eliminar(this);"
						class="btn btn-danger">&nbsp;&nbsp;&nbsp; Eliminar
						&nbsp;&nbsp;&nbsp;</button>
				</div>
			</div>
		</form>
	</div>
</div>
