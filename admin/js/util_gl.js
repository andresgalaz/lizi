var util_gl = util_gl || {
	copiarFilaToForm : function(filaData, formObj) {
		formObj.find('.form-control').each(function(i, campo) {
			if (campo.type !='checkbox'){
				$(campo).val(filaData[campo.id]);
			} else {
				console.log($(campo));
				$(campo).prop('checked', filaData[campo.id] != 0);
			}
		});
	},
	/**
	 * <p>
	 * Convierte los form-control (INPUT) del formularios a un objeto
	 * </p>
	 * @param formObj
	 * @returns {object}
	 */
	formToObjeto : function(formObj) {
		if(!formObj)
			return null;
		var reg = {};
		$(formObj).find('.form-control').each(function(i, campo) {
			var valorPk = $(campo).attr('valor_pk');
			if (valorPk)
				reg[campo.id] = valorPk;
			else if (campo.type =='checkbox'){
				// console.log($(campo).prop('checked'));
				if($(campo).prop('checked')){
					if(reg[campo.id]==undefined)
						reg[campo.id]=[];
					reg[campo.id].push($(campo).val());
				}
			} else
				reg[campo.id] = $(campo).val();
		});
		return reg;
	},
	limpiaForm : function(formObj) {
		$(formObj).find('.form-control').each(function(i, campo) {
			if (campo.type =='checkbox')
				$(campo).prop('checked', false).change();
			else
				$(campo).val('');
		});
	},
	mensajeError : function(comp, cMsg) {
		var cHtml = '<div class="alert alert-danger alert-dismissible" role="alert">'
				+ '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">'
				+ '  <span aria-hidden="true">&times;</span></button>'
				+ '  <strong>Error !</strong> Better check yourself, you`re not looking too good.' + '</div>';
		$(cHtml).insertBefore($(comp));
	},
	/**
	 * <p>
	 * Envía mensaje de confirmación de eliminación. Función Modal
	 * </p>
	 * @param prm Object { titulo: 'Cofirma Opción', mensaje: 'Está seguro que desea borrar ?', fnCallback : function }
	 */
	confirmaBorrar : function(prm) {
		if (typeof (prm) == 'function')
			prm.fnCallback = prm;
		else
			prm = prm || {};

		BootstrapDialog.show({
			title : prm.titulo || 'Cofirma Opción',
			message : prm.mensaje || 'Está seguro que desea borrar ?',
			buttons : [ {
				label : 'Si',
				action : function(dialog) {
					dialog.close();
					if (typeof (prm.fnCallback) == 'function')
						prm.fnCallback();
				}
			}, {
				label : 'No',
				action : function(dialog) {
					dialog.close();
				}
			} ]
		});
	},
	/**
	 * <p>
	 * Mensaje de alerta
	 * </p>
	 * @param prm Object
	 *
	 * <pre>
	 * { titulo: 'Alerta', mensaje: 'Mensaje de Alerta', fnCallback : function }
	 * </pre>
	 */
	mensajeAlerta : function(prm) {
		if (typeof (prm) == 'function')
			prm.fnCallback = prm;
		else
			prm = prm || {};

		BootstrapDialog.show({
			title : prm.titulo || 'Alerta',
			message : prm.mensaje || 'Mensaje de Alerta',
			buttons : [ {
				label : 'Acepta',
				action : function(dialog) {
					dialog.close();
					if (typeof (prm.fnCallback) == 'function')
						prm.fnCallback();
				}
			} ]
		});
	},

	/**
	 * <p>
	 * Envia un producto al carrito de compras
	 * </p>
	 * @param prm object
	 *
	 * <pre>
	 * prm: {
	 * 		idProducto 	: Id del producto a agregar al carrito del usuario
	 * 		nCantidad	: Cantidad del producto a agregar
	 *      bEdit       : Si la cantidad se suma o se edita
	 * }
	 * </pre>
	 */
	agregarCarro : function(me,operacion) {
		if( ! oGlobal.usuario ){
			util_gl.mensajeAlerta({
				mensaje : 'No puede agregar al carro. Primero debe Ingresar usuario / password.'
			});
			return;
		}

		// me: fue el this del boton, se busca el form que lo contiene
		var frm = $(me).parents('form:first')[0];
		frm = $(frm);
		util_gl.callAjaxBase64({
			url : 'agregarCarroAjax.php',
			idProducto : frm.find('#idProducto').val(),
			nCantidad : frm.find('#nCantidad').val(),
			bEdit : (operacion == 'edit'),
			fnCallback : function(resp) {
				if (resp.success) {
					if(operacion=='edit')
						document.location.reload();
					else
						history.back();
				} else {
					util_gl.mensajeAlerta({
						mensaje : resp.mensaje
					});
				}
			}
		});
	},

	/**
	 * <p>
	 * Envia un producto al carrito de compras para eliminar
	 * </p>
	 * @param prm object
	 *
	 * <pre>
	 * prm: {
	 * 		idProducto 	: Id del producto a agregar al carrito del usuario
	 * }
	 * </pre>
	 */
	borrarCarro : function(idProducto) {
		// me: fue el this del boton, se busca el form que lo contiene
		util_gl.callAjaxBase64({
			url : 'borrarCarroAjax.php',
			idProducto : idProducto,
			fnCallback : function(resp) {
				if (resp.success) {
					document.location.reload();
				} else {
					util_gl.mensajeAlerta({
						mensaje : resp.mensaje
					});
				}
			}
		});
	},

	/**
	 * <p>
	 * Primero confirma, si se acepta borra el registro de la base de datos
	 * </p>
	 * @param prm object
	 *
	 * <pre>
	 * prm: {
	 * 		tabla 	: string nombre de la tabla
	 * 		form 	: Componente FORM de la página,
	 * 		pk	  	: Arreglo con los nombre de los campos que conforman la PK
	 * 		paginaRetorno : 'principal.php'
	 * }
	 * </pre>
	 */
	confirmaBorraRegistro : function(prm) {
		util_gl.confirmaBorrar({
			fnCallback : function() {
				util_gl.callAjaxBase64({
					url : prm.url,
					accion : prm.accion || 'delete',
					titulo : prm.titulo || prm.tabla,
					tabla : prm.tabla,
					registro : util_gl.formToObjeto(prm.form),
					pk : prm.pk,
					fnCallback : function(resp) {
						if (resp.success) {
							util_gl.mensajeAlerta({
								titulo : 'Resultado Operación',
								mensaje : 'Registro borrado correctamente',
								fnCallback : function() {
									window.location = prm.paginaRetorno;
								}
							});
						} else {
							util_gl.mensajeAlerta({
								mensaje : resp.mensaje
							});
						}
					}
				});
			}
		});
	},
	/**
	 * <p>
	 * Trae un arreglo con las imagenes de la tabla asociada y su PK
	 * <p>
	 * @param prm
	 *
	 * <pre>
	 * prm: {
	 * 		tabla 	: string nombre de la tabla
	 * 		form 	: Componente FORM de la página,
	 * 		pk	  	: Arreglo con los nombre de los campos que conforman la PK
	 * }
	 *
	 */
	listaImagen : function(prm) {
		util_gl.callAjaxBase64({
			url : prm.url || 'serverAjax/imagen.php',
			accion : 'list',
			tabla : prm.tabla,
			registro : util_gl.formToObjeto(prm.form),
			pk : prm.pk,
			filtro : prm.filtro,
			fnCallback : function(resp) {
				if (typeof (prm.fnCallback) == 'function')
					prm.fnCallback(resp);
			}
		});
	},
	/**
	 * <p>
	 * Trae un arreglo con las imagenes de la tabla asociada y su PK
	 * <p>
	 * @param prm
	 *
	 * <pre>
	 * prm: {
	 * 		tabla 	: string nombre de la tabla
	 * 		form 	: Componente FORM de la página,
	 * 		pk	  	: Arreglo con los nombre de los campos que conforman la PK
	 * }
	 *
	 */
	borraImagen : function(prm) {
		util_gl.callAjaxBase64({
			url : prm.url || 'serverAjax/imagen.php',
			accion : 'delete',
			nombreImagen : prm.nombreImagen,
			fnCallback : function(resp) {
				if (typeof (prm.fnCallback) == 'function')
					prm.fnCallback(resp);
			}
		});
	},
	/**
	 * <p>
	 * Graba Registro en la BD y presenta un mensaje de confirmación final
	 * </p>
	 * @param prm object
	 *
	 * <pre>
	 * prm: {
	 * 		tabla 	: string nombre de la tabla
	 * 		form 	: Componente FORM de la página,
	 * 		pk	  	: Arreglo con los nombre de los campos que conforman la PK
	 * 		paginaRetorno : 'principal.php'
	 * }
	 * </pre>
	 */
	confirmaGrabaRegistro : function(prm) {
		util_gl.callAjaxBase64({
			url : prm.url,
			accion : prm.accion || 'update',
			titulo : prm.titulo || prm.tabla,
			tabla : prm.tabla,
			registro : util_gl.formToObjeto(prm.form),
			pk : prm.pk,
			fnCallback : function(resp) {
				if (resp.success) {
					util_gl.mensajeAlerta({
						titulo : 'Resultado Operación',
						mensaje : resp.mensaje,
						fnCallback : function() {
							window.location = prm.paginaRetorno;
						}
					});
				} else {
					util_gl.mensajeAlerta({
						mensaje : resp.mensaje
					});
				}
			}
		});
	},
	/**
	 * <p>
	 * Borra un registro de la base de datos
	 * </p>
	 * @param prm object
	 *
	 * <pre>
	 * prm: {
	 * 		accion: 'delete',
	 * 		tabla : string nombre de la tabla
	 * 		pk	  : integer u objeto con el valor de la PK a borrar
	 * }
	 * </pre>
	 */
	callAjaxBase64 : function(prm) {
		this.callAjax({
			url : prm.url || 'serverAjax/db.php',
			params : {
				operacion : Base64.encode(JSON.stringify(prm)), depura: JSON.stringify(prm)
			},
			fnCallback : prm.fnCallback
		});
	},
	/**
	 * <p>
	 * LLamada general AJAX modo JSON
	 * </p>
	 * @param prm object
	 *
	 * <pre>
	 * prm = {
	 * 	  accion : 'archivo.php'
	 * 	, params : object // Parámetros
	 * 	, fnCallback : function(response) // Se ejecuta al retorno, y se le pasa como parámetro
	 * 									  // la respuesta del servidor
	 * }
	 * </pre>
	 */
	callAjax : function(prm) {
		$.ajax({
			url : prm.url,
			data : prm.params,
			dataType : 'json',
			type : 'POST',
			success : function(response) {
				if (typeof (prm.fnCallback) == 'function')
					prm.fnCallback(response);
			},
			error : function(x, e) {
				util_gl.mensajeAlerta({
					titulo : prm.titulo,
					mensaje : 'Error al ejecutar accion: ' + prm.accion
				});
			}
		});
	},
	/**
	 * <p>
	 * Crea un control de autocomplete sobre un INPUT tipo TEXT. El uso es similar a la combo.
	 * </p>
	 * @param
	 * <ul>
	 * <li>titulo : Titulo para las ventanas en caso de error. Opcional</li>
	 * <li>idComponente : ID del input a aplicar</li>
	 * <li>descripcion : Campo del registro que se muestra en las sugerencias</li>
	 * <li>valorSeleccionado : Valor pre-asignado al texto</li>
	 * <li>params : Objeto que define la función del servidor a invocar para llenar la lista se sugerencias.</li>
	 * <li>fnCallback : function(val, row) {}, función JS que se llama al momento de seleccionar una sugerencia de la
	 * lista, la función recibe dos parámetros:
	 * <ul>
	 * <li>val: El valor tipo texto de la sugerencia (Campo descripcion).</li>
	 * <li>row: Un objeto con el registro original recibido del servidor</li>
	 * </ul>
	 * </li>
	 * <li>limit : Número máximo de sugerencias. Valor por defecto 5.</li>
	 * </ul>
	 * @author agalaz
	 * @addon Ejemplo de uso:
	 *
	 * <pre>
	 * {
	 * 	componente : $('algo'),
	 * 	tabla : 'anexo01',
	 * 	descripcion : 'cNombre', // Campo que se muestra
	 * 	valor : 'pAnexo01', // Campo que se muestra
	 * 	valorSeleccionado : 'opcional',
	 * 	fnCallback : function(val, row) { // Cuando se selecciona. Opcional
	 * 		if (row)
	 * 			$(&quot;#txCPostal&quot;).val(row.NCP);
	 * 		else
	 * 			$(&quot;#txCPostal&quot;).val('');
	 * 	},
	 * 	limite : 10 // Valor por defecto 5
	 * });
	 * </pre>
	 */
	creaAutoComplete : function(prm) {
		var ctrl = prm.componente;

		util_gl.callAjaxBase64({
			url : prm.url,
			accion : 'list',
			tabla : prm.tabla,
			fnCallback : function(resp) {
				ctrl.typeahead('destroy');
				ctrl.val(prm.valorSeleccionado || '');
				ctrl.typeahead({
					highlight : true,
					hint : true,
					minLength : 0,
					limit : prm.limite || 5,
					selectable : 'Typeahead-selectable',
					local : $.map(resp, function(item) {
						return {
							value : item[prm.descripcion],
							registro : item
						};
					})
				}).on('keypress', function(ev) {
					// Cualquier tecla que cambie el último valor valido, hace que no haya valor valido
					if (this.ultimoValido && this.ultimoValido != this.value)
						this.ultimoValido = null;
				}).on('blur', function(ev) {
					var me = this;
					// Espera 300 milisegundos, si sigue no existe valorValido, limpia el campo de control original
					setTimeout(function() {
						if (!me.ultimoValido) {
							// Si no hay un utlimo válido y el es distinto del valor anterior se limpia porque
							// seguramente no es un valor correcto
							if (me.valorAnterior != me.value) {
								$(me).val('');
								try {
									$(me).typeahead('close');
									$(me).typeahead('setQuery', '');
								} catch (e) {
									console.log('Error setQuery', e);
								}
								// Si callback lo llama para que el programador decida que hacer en caso de error
								if (typeof (prm.fnCallback) == 'function')
									prm.fnCallback(null, null);
							}
						}
					}, 300);
				}).on('focus', function(ev) {
					// Cuando toma el foco borrar el valorValido
					this.ultimoValido = null;
					this.valorAnterior = this.value;
				}).on('typeahead:selected typeahead:autocompleted', function(ev, row) {
					// Solo estos dos eventos son los que pueden poner el valorValido
					if (row) {
						this.ultimoValido = this.value;
						$(this).attr('valor_pk', row.registro[prm.valor]);
						if (typeof (prm.fnCallback) == 'function')
							prm.fnCallback(this.value, row.registro);
					}
				});
			}
		});
	},
	/**
	 * <p>
	 * Llena los OPTION de un campo SELECT
	 * </p>
	 * Ejemplo de 'prm':
	 *
	 * <pre>
	 * {
	 * 	titulo : 'Producto',
	 * 	idComponente : 'cbProducto',
	 * 	params : {
	 * 		prm_dataSource : 'ovQbe',
	 * 		prm_funcion : 'paUtilOv.operObtenerProductos',
	 * 		prm_ciaascod : 1,
	 * 		prm_intranet : 'S'
	 * 	},
	 * 	fnCallback : function(msg) {
	 * 	}, // Opcional. Una vez que carga los registros en la
	 * 	// combo se ejecuta con los datos que llegaron del
	 * 	// servidor.
	 * 	mensaje : 'Seleccione una opción', // Si se omite se genera un mensaje por defecto.
	 * 	// Para que no haya mensaje, enviar un String vacío
	 * 	valor : 'RAMOPDAB',
	 * 	valorSeleccionado : 'AUS1',
	 * 	descripcion : 'RAMPOCOD'
	 * }
	 * </pre>
	 *
	 * Los campos valor y descripción también puede ser una función, por ejemplo:
	 *
	 * <pre>
	 * ...
	 *  valor : function(item){  				// Si se quiere usar valorSeleccionado,
	 *  	return JSON.stringify(item);		// esta también debe ser una función y debe ser booleana
	 *  }
	 *  descripcion : function(item){
	 *  	return item.AGENTCLA + ' | ' + item.AGENTDES;
	 *  }
	 * ...
	 * </pre>
	 */
	creaCombo : function(prm) {
		util_gl.callAjaxBase64({
			url : prm.url,
			accion : 'list',
			tabla : prm.tabla,
			orden : prm.descripcion,
			fnCallback : function(resp) {
				util_gl.comboCarga(prm, resp);
			},
			error : function() {
				util_gl.mensajeAlerta({
					mensaje : 'No se pudo cargar combo de ' + prm.tabla
				});
			}
		});
	},
	/**
	 * Recibe los datos como arreglo y llena la combo.
	 */
	comboCarga : function(prm, records) {
		var cb = null;
		try {
			cb = prm.componente.get(0).options;
		} catch (e) {
		}
		if (!cb)
			return;
		cb.length = 0;

		if (prm.mensaje != undefined) {
			if (prm.mensaje != '')
				cb[0] = new Option(prm.mensaje, '');
		} else
			cb[0] = new Option('Seleccione ' + (prm.titulo || ' ...'), '');

		var bSeleccionado = false;
		var op = null;
		$.each(records, function(index, item) {
			var oValor;
			if (typeof prm.valor == 'function')
				oValor = prm.valor(item);
			else
				oValor = item[prm.valor];

			if (typeof prm.descripcion == 'function')
				op = new Option(prm.descripcion(item), oValor);
			else
				op = new Option(item[prm.descripcion], oValor);
			// Si la preseleccion se determina con una función
			if (typeof prm.valor == 'function') {
				if (prm.valorSeleccionado !== undefined) {
					if (typeof prm.valorSeleccionado == 'function') {
						if (prm.valorSeleccionado(oValor)) {
							$(op).attr('selected', 'selected');
							bSeleccionado = true;
						}
					} else
						console.log('util_gl.comboCarga: Si la propiedad "valor" es una función, '
								+ '"valorSeleccionado" también debe ser una función, y debe ser booleana');
				}
			} else {
				if (prm.valorSeleccionado && item[prm.valor] == prm.valorSeleccionado) {
					$(op).attr('selected', 'selected');
					bSeleccionado = true;
				}
			}
			cb[cb.length] = op;
		});

		// Si hay un solo elemento y no hay seleccionado, este se deja preseleccionado
		if (!bSeleccionado && records.length == 1)
			$(op).attr('selected', 'selected');

	},
	/**
	 * <p>
	 * Baja y muestra las imagenes asociados a una TABLA y PK
	 * </p>
	 * @param prm object
	 * <pre>
	 * 	prm = {
	 * 		imagen : 'ruta archivo',
	 *      fnCallback : function(img){}
	 * 	}
	 * </pre>
	 */
	cargaImagen : function(prm) {
		var url = prm.imagen;
		$.ajax({
			url : url,
			cache : true,
			processData : false,
			success : function(imagen, estado) {
			}
		}).always(function() {
			if(typeof(prm.fnCallback)=='function'){
				var img = $('<img src=""/>');
				$(img).attr("src", url).fadeIn();
				prm.fnCallback(img);
			}
		});
	},
	formatoMonto:function (str) {
	    var parts = (str + "").split("."),
	        main = parts[0],
	        len = main.length,
	        output = "",
	        first = main.charAt(0),
	        i;

	    if (first === '-') {
	        main = main.slice(1);
	        len = main.length;
	    } else {
	        first = "";
	    }
	    i = len - 1;
	    while(i >= 0) {
	        output = main.charAt(i) + output;
	        if ((len - i) % 3 === 0 && i > 0) {
	            output = "." + output;
	        }
	        --i;
	    }
	    // put sign back
	    output = first + output;
	    // put decimal part back
	    if (parts.length > 1) {
	        output += "," + parts[1];
	    }
	    return output;
	},
	validarEmail :function ( email ) {
	    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	    return  !expr.test(email) ;
	},
	enviaMailLimpia:function () {
		$('#contactoErrorID').hide();
		$('#contactoErrorID').html('');
	},
	enviaMail:function (me) {
		var form = $(me).parents('form')[0];
		var objForm = util_gl.formToObjeto($(form));
		var ul = $('<ul/>');
		util_gl.enviaMailLimpia();
		objForm = util_gl.formToObjeto(form);
		if (!objForm.nombre || objForm.nombre == '')
			ul.append('<li>Debe ingresar nombre</li>');
		if (!objForm.telefono || objForm.telefono == '')
			ul.append('<li>Debe ingresar teléfono</li>');
		if (!objForm.email || objForm.email == '')
			ul.append('<li>Debe ingresar email</li>');
		else if (util_gl.validarEmail(objForm.email))
			ul.append('<li>Email no es válido</li>');
		if (!objForm.mensaje || objForm.mensaje == '')
			ul.append('<li>Debe ingresar mensaje</li>');
		if (ul.find('li').length > 0) {
			$('#contactoErrorID').show();
			$('#contactoErrorID').html(ul);
			return;
		}
		// Se envía mensaje
		util_gl.callAjaxBase64({
			url : 'serverAjax/enviaMail.php',
			email : objForm.email,
			asunto : objForm.asunto,
			mensaje : 'Nombre:' + objForm.nombre + "\n" //
					+ 'Teléfono:' + objForm.telefono + "\n" //
					+ 'Email:' + objForm.email + "\n" //
					+ 'Mensaje:' + objForm.mensaje,
			fnCallback : function(resp) {
				if (resp.success) {
					util_gl.mensajeAlerta({
						mensaje : 'El mensaje fue enviado OK.',
						fnCallback : function() {
							$('#contactoFormID').modal('hide');
						}
					});
				} else {
					util_gl.mensajeAlerta({
						mensaje : 'El mensaje no pudo ser enviado ahora, insista mas tarde.',
						fnCallback : function() {
							$('#contactoFormID').modal('hide');
						}
					});
				}
			}
		});
	}
};

/*
 * Configuración DATEPICKER por defecto
 */
try {
	$.fn.datepicker.defaults.language = 'es';
	$.fn.datepicker.defaults.format = 'yyyy-mm-dd';
	$.fn.datepicker.defaults.todayBtn = "linked";
	$.fn.datepicker.defaults.autoclose = true;
} catch (e) {

} finally {

}

//Create Base64 Object
var Base64 = {
	_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
	encode : function(e) {
		var t = "";
		var n, r, i, s, o, u, a;
		var f = 0;
		e = Base64._utf8_encode(e);
		while (f < e.length) {
			n = e.charCodeAt(f++);
			r = e.charCodeAt(f++);
			i = e.charCodeAt(f++);
			s = n >> 2;
			o = (n & 3) << 4 | r >> 4;
			u = (r & 15) << 2 | i >> 6;
			a = i & 63;
			if (isNaN(r)) {
				u = a = 64
			} else if (isNaN(i)) {
				a = 64
			}
			t = t + this._keyStr.charAt(s) + this._keyStr.charAt(o) + this._keyStr.charAt(u) + this._keyStr.charAt(a)
		}
		return t
	},
	decode : function(e) {
		var t = "";
		var n, r, i;
		var s, o, u, a;
		var f = 0;
		e = e.replace(/[^A-Za-z0-9\+\/\=]/g, "");
		while (f < e.length) {
			s = this._keyStr.indexOf(e.charAt(f++));
			o = this._keyStr.indexOf(e.charAt(f++));
			u = this._keyStr.indexOf(e.charAt(f++));
			a = this._keyStr.indexOf(e.charAt(f++));
			n = s << 2 | o >> 4;
			r = (o & 15) << 4 | u >> 2;
			i = (u & 3) << 6 | a;
			t = t + String.fromCharCode(n);
			if (u != 64) {
				t = t + String.fromCharCode(r)
			}
			if (a != 64) {
				t = t + String.fromCharCode(i)
			}
		}
		t = Base64._utf8_decode(t);
		return t
	},
	_utf8_encode : function(e) {
		e = e.replace(/\r\n/g, "\n");
		var t = "";
		for (var n = 0; n < e.length; n++) {
			var r = e.charCodeAt(n);
			if (r < 128) {
				t += String.fromCharCode(r)
			} else if (r > 127 && r < 2048) {
				t += String.fromCharCode(r >> 6 | 192);
				t += String.fromCharCode(r & 63 | 128)
			} else {
				t += String.fromCharCode(r >> 12 | 224);
				t += String.fromCharCode(r >> 6 & 63 | 128);
				t += String.fromCharCode(r & 63 | 128)
			}
		}
		return t
	},
	_utf8_decode : function(e) {
		var t = "";
		var n = 0;
		var r = c1 = c2 = 0;
		while (n < e.length) {
			r = e.charCodeAt(n);
			if (r < 128) {
				t += String.fromCharCode(r);
				n++
			} else if (r > 191 && r < 224) {
				c2 = e.charCodeAt(n + 1);
				t += String.fromCharCode((r & 31) << 6 | c2 & 63);
				n += 2
			} else {
				c2 = e.charCodeAt(n + 1);
				c3 = e.charCodeAt(n + 2);
				t += String.fromCharCode((r & 15) << 12 | (c2 & 63) << 6 | c3 & 63);
				n += 3
			}
		}
		return t
	}
}
