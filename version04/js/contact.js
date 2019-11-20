// Activa MAPA
// function initialize() {
//   var mapOptions = {
//       zoom: 15,
//       center: new google.maps.LatLng(49.1678136, 16.5671893),
//       mapTypeId: google.maps.MapTypeId.ROAD,
//       scrollwheel: false
//   }
//   var map = new google.maps.Map(document.getElementById('map'),
//       mapOptions);
//   var myLatLng = new google.maps.LatLng(49.1681989, 16.5650808);
//   var marker = new google.maps.Marker({
//       position: myLatLng,
//       map: map
//   });
// }
// google.maps.event.addDomListener(window, 'load', initialize);

// Envía correo
function enviaCorreo(frm) {
    if (frm.querySelector('#email').value == '' || frm.querySelector('#message').value == '') {
        $.alert({ content: 'Error: debe indicar email y mensaje al menos', title: 'Lizi Echevarria', type: 'red' });
        return false;
    }
    if (!oGen.isEmail(frm.querySelector('#email').value)) {
        $.alert({ content: 'Error: El Email no es válido', title: 'Lizi Echevarria', type: 'red' });
        return false;
    }

    $.ajax({
        url: 'serverAjax/enviaCorreo.php',
        data: {
            firstname: frm.querySelector('#firstname').value,
            lastname: frm.querySelector('#lastname').value,
            email: frm.querySelector('#email').value,
            subject: frm.querySelector('#subject').value,
            message: frm.querySelector('#message').value
        },
        dataType: 'json',
        type: 'POST',
        success: function (response) {
            $.alert({
                content: response.mensaje, title: 'Lizi Echevarria',
                buttons: { ok: { action: function () { window.location = '.'; } } }
            });
        },
        error: function (x, e) {
            console.error(x, e);
        }
    });
    return true;
}
