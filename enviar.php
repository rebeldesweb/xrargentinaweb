<?php
  require 'classes/Conexion.php';
  require 'classes/Rebelion.php';
  $objRebelion = new Rebelion();
  $bool = $objRebelion->agregarInscripto();
  if ($bool) {

    $para  = $_POST['email']; // atención a la coma
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
      <p class="p1">Hola Bienvenidx a Extinction Rebellion (XR)</p>
      <p class="p1">XR une, bajo un mismo mensaje, a millones de personas que no se sienten representadxs por los sistemas políticos actuales y se oponen a la inacción de los gobiernos y las corporaciones del mundo frente al inminente colapso ecológico y climático. La extinción humana es una posibilidad real si no se toman medidas urgentes para transformar el sistema global de producción y consumo dentro de los próximos diez años, y sentar las bases de una nueva cultura regenerativa</p>
      <p class="p1">Frente a la criminal inacción gubernamental, los ciudadanos del mundo tienen el derecho y el deber de rebelarse pacíficamente.</p>
      <p class="p1">Cómo participar en XR?</p>
      <p class="p1">Cualquiera que promueva los 3 objetivos y cumpla con los <a href="http://xrargentina.org/nosotros.php" target="_blank" rel="noopener">10 principios</a> y valores del movimiento, puede actuar en nombre de XR.</p>
      <p class="p1">Podés formar parte de los equipos de trabajo de XR Argentina, participar de las acciones directas no violentas (ADNV) o armar un grupo local.</p>
      <p class="p1">Cualquiera sea el camino que quieras elegir dentro de XR, el primero paso es participar de una charla del Camino a la Extinción y que hacer al respecto, para entender las bases científicas de las crisis climática y ecosistémica que justifican el llamada a la desobediencia civil pacífica, y profundizar en que es XR, que hacemos y cómo podes sumarte. También podés ver la charla online.</p>
      <p class="p1">Si no entraste aún te invitamos a subirte a nuestro grupo de bienvenida en Telegram XR Argentina</a> aca:<a href="https://t.me/joinchat/HyamYVKXEpEYkYFgMET1Ug" target="new" rel="noopener"> XR Argentina</a></p>
      <p class="p1">Por que telegram? Porque por ahí conversamos y colaboramos entre los voluntarios y es mas seguro que Whatsapp.</p>
      <p class="p1">Te podes bajar Telegram desde el appStore o PlayStore y después también usarlo desde la web <a href="https://web.telegram.org/" target="_blank" rel="noopener" data-saferedirecturl="https://www.google.com/url?q=https://web.telegram.org&amp;amp;source=gmail&amp;amp;ust=1567512988626000&amp;amp;usg=AFQjCNGKq5mhepi0-T6lkiNYa_NlE4D04w">https://web.telegram.org</a></p>
      <p class="p1">Cuando llegues al grupo uno de nuestros coordinadores va a contactarse con vos apenas te sumes a Telegram para acompañarte en los primeros pasos y ayudarte a elegir cómo podes ayudar.</p>
      <p class="p1">Seguinos en nuestras redes sociales para participar en las próximas charlas y acciones.</p>
      <p class="p1">Instagram: <a href="https://www.instagram.com/xrargentina/" target="_blank" rel="noopener">@xrargentina</a></p>
      <p class="p1">Facebook: <a href="https://www.facebook.com/XRargentina/" target="_blank" rel="noopener">xrargentina</a></p>
      <p class="p1">Web:<a href="http://xrargentina.org/" target="_blank" rel="noopener" data-saferedirecturl="https://www.google.com/url?q=http://xrargentina.org&amp;amp;source=gmail&amp;amp;ust=1567512988626000&amp;amp;usg=AFQjCNEnnuWx2yGuvNXWpEs4wvVML4eUHQ">http://xrargentina.org</a></p>
      <p class="p1">Twitter: <a href="https://twitter.com/xrargentina" target="_blank" rel="noopener">XRArgentina</a></p>
      <p class="p1">Te esperamos.</p>
      <p class="p1">Con amor y furia!</p>
    </body>
    </html>
    ';

    // Para enviar un correo HTML, debe establecerse la cabecera Content-type
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    // Cabeceras adicionales
    // $cabeceras .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
    $cabeceras .= 'From: xrargentina <xrargentina@gmail.com>' . "\r\n";
    $cabeceras .= 'Cc: rebeldes@xrargentina.org' . "\r\n";

    // Enviarlo
    $sendMail = mail($para, 'Gracias por sumarte a XR argentina', $mensaje, $cabeceras);

    if ($sendMail) {
      $ultId = $objRebelion->getIdEmail();
      $logEmail = $objRebelion->logEmail($ultId);
    }

    header('location:index.html?suscribido');
  }
?>
