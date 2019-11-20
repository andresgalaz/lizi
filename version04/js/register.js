
// Envía correo
function graba(frm) {
    // Nohace falta porque los campos son required
    // if(frm.checkValidity()===false){
    //     $.alert({ content: 'Error: debe indicar email y mensaje al menos', title: 'Lizi Echevarria', type: 'red' });
    //     return false;
    // }
    // if (cEmail == '' || cName == '' || cPassword == '') {
    //     $.alert({ content: 'Error: debe indicar email y mensaje al menos', title: 'Lizi Echevarria', type: 'red' });
    //     return false;
    // }
    if (!oGen.isEmail(frm.querySelector('#email').value)) {
        $.alert({ content: 'Email no es válido', title: 'Lizi Echevarria', type: 'red' });
        return false;
    }
    if (frm.querySelector('#password').value.length < 3) {
        $.alert({ content: 'Password demasiado corta', title: 'Lizi Echevarria', type: 'red' });
        return false;
    }

    $.ajax({
        url: 'serverAjax/clienteGraba.php',
        data: {
            cNombre: frm.querySelector('#name').value,
            cEmail: frm.querySelector('#email').value,
            cPassword: frm.querySelector('#password').value
        },
        dataType: 'json',
        type: 'POST',
        success: function (response) {
            if (response.success === true) {
                $.alert({
                    content: response.mensaje, title: 'Lizi Echevarria',
                    buttons: { ok: { action: function () { window.location = '.'; } } }
                });
            } else {
                $.alert({ content: response.mensaje, title: 'Lizi Echevarria', type: 'red' });
            }
        },
        error: function (x, e) {
            console.error(x, e);
            $.alert({ content: 'Problemas de comunicación con el servidor<br>Inténtelo mas tarde.', title: 'Lizi Echevarria', type: 'red' });
        }
    });
    return true;
}
