
<?php
// Varios destinatarios
$para  = 'francobenitez980@gmail.com'; // atención a la coma
// título
// Subject
$asunto = 'Te has registrado con éxito en xrargentina';

    // Message
    $mensaje = '
    <html>
    <head>
      <title>Birthday Reminders for August</title>
      <meta charset="utf-8">
    </head>
    <body>
      
    </body>
    </html>
    ';

    // Para enviar un correo HTML, debe establecerse la cabecera Content-type
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    // Cabeceras adicionales
    // $cabeceras .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
    $cabeceras .= 'From: xrargentina <xrargentina@gmail.com>' . "\r\n";
    $cabeceras .= 'Cc: franco_casla_benitez@hotmail.com' . "\r\n";

    // Enviarlo
    $sendMail = mail($para, 'Gracias por sumarte a XR argentina', $mensaje, $cabeceras);

    if ($sendMail) {
      echo 'Se envio';
    }else{
      echo 'no se envio';
    }

?>
