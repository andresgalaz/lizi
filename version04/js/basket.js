// Envía correo de Suscripción
function cambiaCantidad(itm, pPrincipal, nStock) {
    var form = $(itm).closest('form');
    if (itm.value > nStock) {
        $.alert({
            content: 'Su cantidad solicitada excede nuestro stock', title: 'Lizi Echevarria', type: 'red',
            buttons: {
                ok: { action: function () { submitBasket(form, pPrincipal, nStock); } }
            }
        });
        return true;
    }
    submitBasket(form, pPrincipal, itm.value);
    return true;
}

function submitBasket(form, pPrincipal, nCantidad) {
    form.attr('action', 'basket.php?pPrincipal=' + pPrincipal + "&nCantidad=" + nCantidad).trigger('submit');
}

$(document).ready(function () {
    console.log(cMensajeNoStock);
    if (cMensajeNoStock.length > 0) {
        cMensajeNoStock = '<ul>' + cMensajeNoStock + '</ul>';
        $.alert({
            content: 'Los siguientes productos no tienen stock:<br/><br/>' + cMensajeNoStock +
                'Nos pondremos en contacto. si es que no cambia de producto'
            , title: 'Lizi Echevarria'
        });
    }
});