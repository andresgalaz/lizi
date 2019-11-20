/**
 * Guarda datos de la compra
 * @param {*} frm Objeto formulario que contiene los campos
 */
function graba(frm) {
    console.log('graba checkout');
    if (!oGen.isEmail(frm.querySelector('#cEmail').value)) {
        $.alert({ content: 'Email no es válido', title: 'Lizi Echevarria', type: 'red' });
        return false;
    }
    if (!oGen.isPhone(frm.querySelector('#cTelefono').value)) {
        $.alert({ content: 'Nº teléfono no es válido.<br/>Se espera algo así: 54911-123456', title: 'Lizi Echevarria', type: 'red' });
        return false;
    }
    if (frm.querySelector('#cPostal').value.length != 4) {
        $.alert({ content: 'Se espera un código postal numérico de largo 4', title: 'Lizi Echevarria', type: 'red' });
        return false;
    }
    if (frm.querySelector('#cTelefono').value.length < 6) {
        $.alert({ content: 'Número de teléfono incorrecto', title: 'Lizi Echevarria', type: 'red' });
        return false;
    }

    $.ajax({
        url: 'serverAjax/grabaCompra.php',
        data: {
            cNombre: frm.querySelector('#cNombre').value,
            cApellido: frm.querySelector('#cApellido').value,
            cDireccion: frm.querySelector('#cDireccion').value,
            cProvincia: frm.querySelector('#cProvincia').value,
            cPostal: frm.querySelector('#cPostal').value,
            cEmail: frm.querySelector('#cEmail').value,
            cTelefono: frm.querySelector('#cTelefono').value
        },
        dataType: 'json',
        type: 'POST',
        success: function (response) {
            if (response.success === true) {
                window.location = 'checkout4.php';
                // $.alert({
                //     content: response.mensaje, title: 'Lizi Echevarria',
                //     buttons: { ok: { action: function () { window.location = 'checkou4.php'; } } }
                // });
            } else {
                $.alert({ content: response.mensaje, title: 'Lizi Echevarria', type: 'red' });
            }
        },
        error: function (x, e) {
            console.error(x);
            console.error(e);
            $.alert({ content: 'Problemas de comunicación con el servidor<br>Inténtelo mas tarde.', title: 'Lizi Echevarria', type: 'red' });
        }
    });
    return true;
}

/**
 * Hace un submit a todo pago
 * @param {*} frm Objeto formulario que contiene los campos
 */
function callTodoPago(frm) {
    console.log('call "Todo Pago"');
}
