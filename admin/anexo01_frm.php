<div class='row'>
	<div class='col-md-12'>
		<form id='divAnexo01Frm' class='form-horizontal'>
			<div class='form-group'>
				<label class='col-lg-2 col-xs-12 control-label' for='pAnexo01'>Id.
					Anexo01</label>
				<div class='col-lg-10 col-xs-12'>
					<input id='pAnexo01' readonly maxlength='11' type='text'
						class='form-control integer' />
				</div>
			</div>
			<div class='form-group'>
				<label class='col-lg-2 col-xs-12 control-label' for='cNombre'>Nombre</label>
				<div class='col-lg-10 col-xs-12'>
					<input id='cNombre' maxlength='40' type='text'
						class='form-control upper alfabetico' />
				</div>
			</div>
			<div class='form-group'>
				<label class='col-lg-2 col-xs-12 control-label' for='cDescripcion'>Descripción</label>
				<div class='col-lg-10 col-xs-12'>
					<textarea id='cDescripcion' class="form-control" rows="8"></textarea>
				</div>
			</div>
			<div class='form-group'>
				<div class='col-lg-6 col-xs-12'></div>
				<div class='col-lg-2 col-xs-2'>
					<button type="button" onclick="oAnexo01.nuevo(this);"
						class="btn btn-success">&nbsp;&nbsp;&nbsp; Nuevo
						&nbsp;&nbsp;&nbsp;</button>
				</div>
				<div class='col-lg-3 col-xs-3'>
					<button type="button" onclick="oAnexo01.grabar(this);"
						class="btn btn-primary">&nbsp;&nbsp;&nbsp; Grabar
						&nbsp;&nbsp;&nbsp;</button>
				</div>
				<div class='col-lg-2 col-xs-2'>
					<button type="button" onclick="oAnexo01.eliminar(this);"
						class="btn btn-danger">&nbsp;&nbsp;&nbsp; Eliminar
						&nbsp;&nbsp;&nbsp;</button>
				</div>
			</div>
		</form>
	</div>
</div>