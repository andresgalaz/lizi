var oAnexo01 = {
	/**
	 * Borra Imagen en el servidor, usando como base el boton dentro del DIV
	 * @param me
	 */
	borrarImagen : function(me) {
		console.log(me);
		var div = $(me).parent('div')[0];
		var img = $(div).find('img')[0];
		var src = $(img).attr('src');

		if (!src || src == '')
			return false;
		util_gl.borraImagen({
			nombreImagen : src,
			fnCallback : function(resp) {
				div.remove();
			}
		})
		return true;
	},
	/**
	 * Limpia formulario para ingresar un nuevo registro
	 * @param me
	 */
	nuevo : function(me) {
		var formObj = $(me).parents('form').get(0);
		util_gl.limpiaForm(formObj);
	},
	/**
	 * Borra registro anexo01
	 * @param me
	 */
	eliminar : function(me) {
		var formObj = $(me).parents('form').get(0);
		util_gl.confirmaBorraRegistro({
			url : 'serverAjax/anexo01.php?eliminar',
			tabla : 'anexo01',
			form : formObj,
			pk : [ 'pAnexo01' ],
			paginaRetorno : 'anexo01.php'
		})
	},
	/**
	 * Actualiza registro anexo01
	 * @param me
	 */
	grabar : function(me) {
		var formObj = $(me).parents('form').get(0);
		util_gl.confirmaGrabaRegistro({
			url : 'serverAjax/anexo01.php?grabar',
			tabla : 'anexo01',
			form : formObj,
			pk : [ 'pAnexo01' ],
			paginaRetorno : 'anexo01.php'
		})
	},
	/**
	 * Trae un arreglo con un arreglo de las imágenes asociadas al registro
	 * @param me
	 */
	imagenes : function(me) {
		var formObj = $('#divAnexo01Frm');
		console.log(formObj);
		util_gl.listaImagen({
			url : 'serverAjax/anexo01.php?imagenes',
			tabla : 'anexo01',
			form : formObj,
			pk : 'pAnexo01',
			fnCallback : function(resp) {
				$('#imagenAdminID').html('');
				for (var i = 0; i < resp.length; i++) {
					var pos = resp[i].lastIndexOf("/");
					var cNombre = resp[i].substring(pos + 1);
					$('#imagenAdminID').append($('<div class="col-lg-2 col-md-3 col-xs-6 thumb" ' //
							+ ' style="background-color:#303030; padding: 10px;">' //
							+ cNombre + '<br/>' //
							+ '  <div style="background-color:#363636; padding:10px;" class="img-thumbnail">' //
							+ '    <img src="../' + resp[i] + '" class="img-thumbnail"/>' //
							+ '  </div>' //
							+ '  <input type="button" class="btn btn-primary" value="Borrar"'//
							+ '         onclick="oAnexo01.borrarImagen(this)"/>' //
							+ '</div>'));
				}
			}
		});
	}
};

$(document).ready(function() {
	$('#anexo01Tabla').bootstrapTable({
		onClickRow : function(row, el) {
			util_gl.copiarFilaToForm(row, $('#divAnexo01Frm'));
			oAnexo01.imagenes();
		},
		pagination : true,
		pageList : [ 10, 20 ],
		pageSize : 5
	});

	$('#dFecha').datepicker({
		format : 'yyyy-mm-dd'
	});

	util_gl.creaCombo({
		componente : $('#pAnexo01'),
		tabla : 'anexo01',
		descripcion : 'cNombre',
		valor : 'pAnexo01'
	});

	util_gl.creaCombo({
		componente : $('#cTipo'),
		tabla : 'tipo',
		descripcion : 'cTipo'
	});

});
