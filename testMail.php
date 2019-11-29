<?php


$remitente = 'no-responder@liziechevarria.com';
$destinatario = 'info@liziechevarria.com'; // 'andres.galaz@gmail.com';
$asunto = "Te contactaron en el formulario de tu sitio web v2.3";
$mensaje = "Tienes un mensaje desde el formulario de tu sitio web";
$headers = "From: $remitente\r\nReply-to: $remitente";

mail($destinatario, $asunto, $mensaje, $headers);
?>
<html>
    <head></head>
    <body>
        <h3>
            mail(<?=$destinatario?>, <?=$asunto?>, <?=$mensaje?>, <?=$headers?>);
        </h3>
    </body>
</html>