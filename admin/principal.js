var oPrincipal = {
    /**
     * Borra Imagen en el servidor, usando como base el boton dentro del DIV
     * @param me
     */
    borrarImagen: function (me) {
        console.log(me);
        var div = $(me).parent('div')[0];
        var img = $(div).find('img')[0];
        var src = $(img).attr('src');

        if (!src || src == '')
            return false;
        util_gl.borraImagen({
            nombreImagen: src,
            fnCallback: function (resp) {
                div.remove();
            }
        })
        return true;
    },
    /**
     * Limpia formulario para ingresar un nuevo registro
     * @param me
     */
    nuevo: function (me) {
        var formObj = $(me).parents('form').get(0);
        util_gl.limpiaForm(formObj);
    },
    /**
     * Borra registro principal
     * @param me
     */
    eliminar: function (me) {
        var formObj = $(me).parents('form').get(0);
        util_gl.confirmaBorraRegistro({
            url: 'serverAjax/principal.php?eliminar',
            tabla: 'principal',
            form: formObj,
            pk: ['pPrincipal'],
            paginaRetorno: 'principal.php'
        })
    },
    /**
     * Actualiza registro principal
     * @param me
     */
    grabar: function (me) {
        var formObj = $(me).parents('form').get(0);
        util_gl.confirmaGrabaRegistro({
            url: 'serverAjax/principal.php?grabar',
            tabla: 'principal',
            form: formObj,
            pk: ['pPrincipal'],
            paginaRetorno: 'principal.php'
        })
    },
    /**
     * Trae un arreglo con los atributos
     * @param me
     */
    atributos: function (me) {
        var formObj = $('#divPrincipalFrm');
        // Limpia los atributos
        $('[id="atributo"]').each(function (i, campo) {
            $(campo).prop('checked', false).change();
        });
        util_gl.callAjaxBase64({
            url: 'serverAjax/principal.php?atributos',
            registro: util_gl.formToObjeto(formObj),
            fnCallback: function (resp) {
                for (var i = 0; i < resp.length; i++) {
                    var elem = resp[i];
                    $('#atributo[value="' + elem.cAtributo + '"]').prop('checked', true).change();
                }
            }
        });
    },
    /**
     * Trae un arreglo con un arreglo de las imágenes asociadas al registro
     * @param me
     */
    imagenes: function (me) {
        var formObj = $('#divPrincipalFrm');
        console.log(formObj);
        util_gl.listaImagen({
            url: 'serverAjax/principal.php?imagenes',
            tabla: 'principal',
            form: formObj,
            pk: 'pPrincipal',
            fnCallback: function (resp) {
                $('#imagenAdminID').html('');
                for (var i = 0; i < resp.length; i++) {
                    var pos = resp[i].lastIndexOf("/");
                    var cNombre = resp[i].substring(pos + 1);
                    var tsImg=new Date().getTime();
                    $('#imagenAdminID').append($('<div class="col-lg-2 col-md-3 col-xs-6 thumb" ' +
                        ' style="background-color:#303030; padding: 10px;">' +
                        cNombre + '<br/>' +
                        '  <div style="background-color:#363636; padding:10px;" class="img-thumbnail">' +
                        '    <img src="../' + resp[i] + '?x=' + tsImg + '" class="img-thumbnail"/>' +
                        '  </div>' +
                        '  <input type="button" class="btn btn-primary" value="Borrar"' +
                        '         onclick="oPrincipal.borrarImagen(this)"/>' +
                        '</div>'));
                }
            }
        });
    }

};

$(document).ready(function () {
    $('#principalTabla').bootstrapTable({
        onClickRow: function (row, el) {
            util_gl.copiarFilaToForm(row, $('#divPrincipalFrm'));
            oPrincipal.imagenes();
            oPrincipal.atributos();
        },
        pagination: true,
        pageList: [10, 20],
        pageSize: 5
    });

    $('#dFecha').datepicker({
        format: 'yyyy-mm-dd'
    });

    util_gl.creaCombo({
        componente: $('#pAnexo01'),
        tabla: 'anexo01',
        descripcion: 'cNombre',
        valor: 'pAnexo01'
    });

    util_gl.creaCombo({
        componente: $('#cTipo'),
        tabla: 'tipo',
        descripcion: 'cTipo'
    });


    // $("input[type=checkbox]").on("change", function () {
    $('[id="atributo"]').on("change", function () {
        var me = this;
        me.parentElement.classList.remove('btn-warning');
        if (me.checked)
            me.parentElement.classList.add('btn-warning');
    });

    util_gl.creaCombo({
        componente: $('#cTpVarios01'),
        tabla: 'tp_varios01',
        descripcion: 'cTpVarios01'
    });
    util_gl.creaCombo({
        componente: $('#cProvincia'),
        tabla: 'provincia',
        descripcion: 'cProvincia'
    });

});
