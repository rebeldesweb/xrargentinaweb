<?php
  header('Access-Control-Allow-Origin: *');
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
      <p class="p1">Nuestra misión(XR)</p>
      <p class="p1">Frente al inminente colapso ecológico y climático, XR une, bajo un mismo mensaje, a millones de personas que no se sienten representadas por los sistemas políticos actuales y se oponen a la inacción de los gobiernos y las corporaciones del mundo. 
      La extinción humana es una posibilidad real si no se toman medidas urgentes para transformar el sistema global de producción y consumo empezando ahora. Debemos además sentar las bases de una nueva cultura regenerativa. 
      Frente a la criminal inacción gubernamental, les ciudadanes del mundo tienen el derecho y el deber de rebelarse pacíficamente.</p>
      
      <p class="p1">Tu participación</p>
      <p class="p1">→ Cualquier persona que promueva las <a href="xrargentina.org/demandas.php">tres demandas</a> y cumpla con los <a href="xrargentina.org/nosotros.php">diez principios</a> y valores del movimiento, puede actuar en nombre de XR.</p>
      <p class="p1">→ Podés formar parte de los equipos de trabajo de XR Argentina, participar de las acciones directas no violentas (ADNV) o armar un grupo local.</p>

      <p class="p1">Lo básico</p>
      <p class="p1">→ Es importante que entiendas las bases científicas de la crisis climática y ecosistémiica que justifican la desobediencia civil pacífica.</p>
      <p class="p1">→ Queremos que profundices en qué es XR, qué hacemos y cómo podés sumarte.</p>
      <p class="p1">El primer paso es que veas la charla <a href="https://www.youtube.com/watch?v=XS0OWsGvcT4">“Rumbo a la Extinción y qué hacer al respecto”.</a> También podés participar cuando hagamos esta charla de manera presencial.</p>

      <p class="p1">Cómo nos comunicamos</p>
      <p class="p1">Usamos Telegram. Es un sistema de mensajería más seguro que Whatsapp, donde conversamos y colaboramos entre les voluntaries.
      Te podés bajar Telegram desde el appStore o PlayStore y después usarlo desde la web https://web.telegram.org o versión desktop.</p>

      <p class="p1">Te invitamos a subirte a nuestro grupo de bienvenida en Telegram XR Argentina clickeando acá: <a href="https://t.me/joinchat/HyamYVKXEpEYkYFgMET1Ug">XR Argentina.</a> Cuando llegues al grupo, une de nuestres coordinadores se va a contactar con vos para acompañarte en los primeros pasos y ayudarte a elegir cómo podés ayudar.</p>

      <p class="p1">Además, seguinos en nuestras redes sociales para participar en las próximas charlas y acciones.</p>
      <p class="p1">Instagram: <a href="https://www.instagram.com/xrargentina/" target="_blank" rel="noopener">@xrargentina</a></p>
      <p class="p1">Facebook: <a href="https://www.facebook.com/XRargentina/" target="_blank" rel="noopener">xrargentina</a></p>
      <p class="p1">Web:<a href="https://xrargentina.org/" target="_blank" rel="noopener" data-saferedirecturl="https://www.google.com/url?q=http://xrargentina.org&amp;amp;source=gmail&amp;amp;ust=1567512988626000&amp;amp;usg=AFQjCNEnnuWx2yGuvNXWpEs4wvVML4eUHQ">http://xrargentina.org</a></p>
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
