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
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Birthday Reminders for August</title>
      
    </head>
    <body>
      <p class="p1">Hola Bienvenidx a Extinction Rebellion (XR)</p>
      <p class="p1">Nuestra misión(XR)</p>
      <p>Frente al inminente colapso ecológico y climático, XR une, bajo un mismo mensaje, a millones de personas que no se sienten representadas por los sistemas políticos actuales y se oponen a la inacción de los gobiernos y las corporaciones del mundo.
      La extinción humana es una posibilidad real si no se toman medidas urgentes para transformar el sistema global de producción y consumo empezando ahora. Debemos además sentar las bases de una nueva cultura regenerativa.
      Frente a la criminal inacción gubernamental, les ciudadanes del mundo tienen el derecho y el deber de rebelarse pacíficamente.</p>

      <p class="p1">Tu participación</p>
      <p>→ Cualquier persona que promueva las <a href="xrargentina.org/demandas.php">tres demandas</a> y cumpla con los <a href="xrargentina.org/nosotros.php">diez principios</a> y valores del movimiento, puede actuar en nombre de XR.</p>
      <p>→ Podés formar parte de los equipos de trabajo de XR Argentina, participar de las acciones directas no violentas (ADNV) o armar un grupo local.</p>

      <p class="p1">Lo básico</p>
      <p>→ Es importante que entiendas las bases científicas de la crisis climática y ecosistémiica que justifican la desobediencia civil pacífica.</p>
      <p>→ Queremos que profundices en qué es XR, qué hacemos y cómo podés sumarte.</p>
      <p>El primer paso es que veas la charla <a href="https://www.youtube.com/watch?v=XS0OWsGvcT4">“Rumbo a la Extinción y qué hacer al respecto”.</a> También podés participar cuando hagamos esta charla de manera presencial.</p>

      <p class="p1">Cómo nos comunicamos</p>
      <p>Usamos Telegram. Es un sistema de mensajería más seguro que Whatsapp, donde conversamos y colaboramos entre les voluntaries.
      Te podés bajar Telegram desde el appStore o PlayStore y después usarlo desde la web https://web.telegram.org o versión desktop.</p>

      <p>Te invitamos a subirte a nuestro grupo de bienvenida en Telegram XR Argentina clickeando acá: <a href="https://t.me/joinchat/LOrzQVKXEpGVCpjLhSQ52Q">XR Argentina.</a> Cuando llegues al grupo, une de nuestres coordinadores se va a contactar con vos para acompañarte en los primeros pasos y ayudarte a elegir cómo podés ayudar.</p>

      <p>Además, seguinos en nuestras redes sociales para participar en las próximas charlas y acciones.</p>
      <p>Instagram: <a href="https://www.instagram.com/xrargentina/" target="_blank" rel="noopener">@xrargentina</a></p>
      <p>Facebook: <a href="https://www.facebook.com/XRargentina/" target="_blank" rel="noopener">xrargentina</a></p>
      <p>Web:<a href="https://xrargentina.org/" target="_blank" rel="noopener" data-saferedirecturl="https://www.google.com/url?q=http://xrargentina.org&amp;amp;source=gmail&amp;amp;ust=1567512988626000&amp;amp;usg=AFQjCNEnnuWx2yGuvNXWpEs4wvVML4eUHQ">http://xrargentina.org</a></p>
      <p>Twitter: <a href="https://twitter.com/xrargentina" target="_blank" rel="noopener">XRArgentina</a></p>
      <p>Te esperamos.</p>
      <p>Con amor y furia!</p>
    </body>
    </html>
    ';

    // Para enviar un correo HTML, debe establecerse la cabecera Content-type
    /*$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    // Cabeceras adicionales
    // $cabeceras .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
    $cabeceras .= 'From: xrargentina <xrargentina@gmail.com>' . "\r\n";
    $cabeceras .= 'Cc: rebeldes@xrargentina.org' . "\r\n";

    // Enviarlo
    $sendMail = mail($para, 'Gracias por sumarte a XR argentina', $mensaje, $cabeceras);*/



	require_once("PHPMailer/class.phpmailer.php");
	require_once("PHPMailer/class.smtp.php");


	//$from = "xrargentina@gmail.com";
	$from = "info@xrargentina.org";
	$nameFrom = "xrargentina";
	
	

	$mail = new PHPMailer();

	
	$mail->isSMTP();
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 0;
	//Ask for HTML-friendly debug output
	$mail->Debugoutput = 'html';
	//Set the hostname of the mail server
	$mail->Host = "mail.xrargentina.org";
	//Set the SMTP port number - likely to be 25, 465 or 587
	$mail->Port = 587;
	$mail->SMTPSecure = "TLS";
	//Whether to use SMTP authentication
	$mail->SMTPAuth = true;
	//Username to use for SMTP authentication
	$mail->Username = "info@xrargentina.org";
	//Password to use for SMTP authentication
	$mail->Password = "Hoy11Feb20";
	$mail->Sender =$from;
    $mail->ReturnPath=$from;
	//Set who the message is to be sent from
	$mail->setFrom($from, $nameFrom);
	//Set an alternative reply-to address
	$mail->addReplyTo($from, $nameFrom);
	//Set who the message is to be sent to
	$mail->addAddress($para);
	//Set the subject line
	$mail->Subject = $asunto;
	$body = $mensaje;
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML($body);
	//Replace the plain text body with one created manually
	$mail->AltBody = $body;
	
	
	
	$mail->CharSet = 'UTF-8';
	
	$mail->HeaderLine("Organization" , SITE); 
    $mail->HeaderLine("Content-Transfer-encoding" , "8bit");
    $mail->HeaderLine("Message-ID" , "<".md5(uniqid(time()))."@{$_SERVER['SERVER_NAME']}>");
    $mail->HeaderLine("X-MSmail-Priority" , "Normal");
    $mail->HeaderLine("X-Mailer" , "Microsoft Office Outlook, Build 11.0.5510");
    $mail->HeaderLine("X-MimeOLE" , "Produced By Microsoft MimeOLE V6.00.2800.1441");
    $mail->HeaderLine("X-Sender" , $mail->Sender);
    $mail->HeaderLine("X-AntiAbuse" , "This is a solicited email for - ".SITE." mailing list.");
    $mail->HeaderLine("X-AntiAbuse" , "Servername - {$_SERVER['SERVER_NAME']}");
    $mail->HeaderLine("X-AntiAbuse" , $mail->Sender);
	$mail->HeaderLine('Return-Path', '<'.trim($mail->ReturnPath).'>');

	

	$sendMail=	$mail->Send();
	
    $dt = date('Y-m-d G:i:s');

    $_Log = fopen("logs/enviosEmail.log", "a+") or die("Operation Failed!");

    if ($sendMail) {
      $ultId = $objRebelion->getIdEmail();
      $logEmail = $objRebelion->logEmail($ultId);
       fputs($_Log, $dt . " --> Enviado: " . $para ."\n");
    }
    else  fputs($_Log, $dt . " --> NO enviado: " . $para ."\n");
    
     fclose($_Log);

    header('location:index.html?suscribido');
  }
?>