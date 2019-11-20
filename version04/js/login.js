
function login(frm) {
    $.ajax({
        url: 'serverAjax/clienteLogin.php',
        data: {
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
