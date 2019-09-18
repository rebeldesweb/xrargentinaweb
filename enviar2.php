<?php
  // require 'data.php';
  // $validacionDatos = suscribir();
  // if (!$validacionDatos) {
  //   header('location: index.php?error=1');
  // }else {
  //
  //

    // $asuntoFinal = 'NUEVO SUSCRIPTOR';
    // $destino = 'francobenitez980@gmail.com';
    //
    $nombre = 'franco';
    $apellido = 'bentez';
    $telefono = 0000;
    $cdgPostal = 000;
    $email = 'admin@admin.com';
    // $mensaje = 'nombre: '. $nombre . "\n";
    // $mensaje .= 'apellido: '. $apellido . "\n";
    // $mensaje .= 'telefono: '. $telefono . "\n";
    // $mensaje .= 'Codigo postal: '. $cdgPostal . "\n";
    // $mensaje .= 'email: '. $email;
    // $headers = 'From: xrargentina' . "\r\n" .
    // 'Reply-To: '. $email . "\r\n" .
    // 'X-Mailer: PHP/' . phpversion();
    //
    // $mail = mail($destino,$asuntoFinal,$mensaje, $headers);
    // Multiple recipients
$to = 'info@ricardogiacomin.com'; // note the comma

// Subject
$subject = 'Contacto desde xrargentina web site';

// Message
$message = '
<html>
<head>
  <title>Nuevo suscriptor</title>
</head>
<body>
  <h1>NUEVO SUSCRIPTOR</h1>
  <table>
    <tr>
      <td>Nombre:</td><b>'. $nombre .'</b></td>
    </tr>
    <tr>
      <td>Apellido:</td><b>'. $apellido .'</b></td>
    </tr>
    <tr>
      <td>Teléfono:</td><b>'. $telefono .'</b></td>
    </tr>
    <tr>
      <td>Código postal:</td><b>'. $cdgPostal .'</b></td>
    </tr>
    <tr>
      <td>Email:</td><b>'. $email .'</b></td>
    </tr>
  </table>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';

// Additional headers
$headers[] = 'From:'. $nombre . ' ' . $apellido .'<example@example.com>';


// Mail it
mail($to, $subject, $message, implode("\r\n", $headers));
?>
