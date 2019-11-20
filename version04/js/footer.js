// Envía correo de Suscripción
function enviaSuscripcion(frm) {
    if (frm.querySelector('#email').value == '') {
        return false;
    }
    if (!oGen.isEmail(frm.querySelector('#email').value)) {
        $.alert({ content: 'Error: El Email no es válido', title: 'Lizi Echevarria', type: 'red' });
        return false;
    }

    $.ajax({
        url: 'serverAjax/enviaSuscripcion.php',
        data: {
            email: frm.querySelector('#email').value
        },
        dataType: 'json',
        type: 'POST',
        success: function (response) {
            $.alert({
                content: response.mensaje, title: 'Lizi Echevarria',
                buttons: {
                    ok: {
                        action: function () { frm.querySelector('#email').value = ''; }
                    }
                }
            });
        },
        error: function (x, e) {
            console.error(x, e);
        }
    });
    return true;
}
