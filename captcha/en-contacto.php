<?php

include_once('include/config.php');
include_once('include/database.php');
include_once('include/functions.php');
include_once('include/Mobile_Detect.php'); 

$nombre= "Contactate con Grupo Oxean";
$cat= 5;
$descripcion = "La Comunicación Cross vela por la coherencia entre el negocio, su identidad y cultura, y su comunicación interna y externa. En Oxean Comunicación Interna somos socios estratégicos, creadores de ideas y proponemos trabajar sobre la perspectiva que nos permite transitar exitosamente por el ecosistema empresario. Creemos que la comunicación externa debe estar alineada tanto a la identidad y cultura organizacional, como a su marca y su comunicación interna.";
$title = "- " . $nombre;

include_once('header.php'); 

include_once('captcha/ReCaptcha.php');
include_once('captcha/RequestMethod.php');
include_once('captcha/RequestParameters.php');
include_once('captcha/Response.php');
include_once('captcha/RequestMethod/Post.php');
include_once('captcha/RequestMethod/Socket.php');
include_once('captcha/RequestMethod/SocketPost.php');

?>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>


        <!-- Graficos -->
        <section class="fluid-container graficos bgLightGrey">
            <div class="container">
            <?php
                echo '<div class="col-lg-8"><h2><img src="' . URL . '/img/secciones/titulo_en_contacto.png" alt="' . $nombre . '"></h2></div>';
            ?>
            </div>
        </section>
        <!-- Fin Graficos -->

        <div class="clearfix"></div>

        <!-- Graficos -->
        <section class="fluid-container contenedorContacto bgLightGrey">
            <div class="container">
                
                <div class="row address">
                    <div class="col-md-6 col-lg-6">
                        <i class="fa fa-map-marker"></i>
                        <img src="img/banderas/Argentina_flat.png" alt="Brasil">
                        <strong>Argentina - Buenos Aires</strong><br>
                        Av. del Libertador 6250 5 Piso Dpto B - C1428 - Belgrano - CABA
                        <div class="clearfix"></div>
                    </div>

                    <div class="col-md-6 col-lg-6">
                        <i class="fa fa-envelope"></i>
                        Tel: (+54 11) 4788 8699<br>
                        contacto@grupooxean.com
                    </div>
                </div>

                <?php
                        $clave_del_sitio = "6LelZScTAAAAAC2IsOM61ASKbMpPMGGq-BiXFh7R";
                        $clave_secreta = "6LelZScTAAAAAIlKChQF56dRX-hmTWmjwVV-DeuH";


                        if (!empty($_POST["submit_info_contact"])) {

                            $recaptcha = new \ReCaptcha\ReCaptcha($clave_secreta);
                            $respuesta = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);                          
                            
                            if($respuesta->isSuccess()){
                                $correo = strip_tags($_POST["email"]);
                                $nombre = strip_tags($_POST["nombre"]);
                                $empresa = strip_tags($_POST["empresa"]);
                                $telefono = strip_tags($_POST["telefono"]);
                                $comentario = strip_tags($_POST["comentario"]);


                                $cuerpo = "Contacto - OXEAN ARGENTINA<br><br> Enviado por: " . $nombre . "<br>Correo Electronico: " . $correo . "<br>Empresa: " . $empresa . "<br>Telefono: " . $telefono . "<br><br><br>Comentario: " . $comentario;
                                $asunto = "Contacto - OXEAN ARGENTINA";
                                $destino = "contacto@grupooxean.com";

                                require('include/PHPMailer/class.phpmailer.php');


                                    $phpMailer = new PHPMailer();
                                    
                                    $phpMailer->IsHTML();
                                    $phpMailer->CharSet = 'utf-8';
                                    $phpMailer->set('Sender', $nombre);
                                    $phpMailer->set('From', $correo);
                                    $phpMailer->set('FromName', $nombre);
                                    $phpMailer->AddAddress($destino);

                                    $phpMailer->set('Subject', $asunto);
                                    $phpMailer->set('Body', $cuerpo);

                                    //envío el mensaje, comprobando si se envió correctamente
                                    if(!$phpMailer->Send()) {
                                        echo "<br><div class='alert alert-dismissable alert-danger' style='width: 70%!important; margin: 20px auto; text-align: center;'>
                                                <strong>Se ha producido un error</strong> " . $phpMailer->ErrorInfo . " 
                                              </div>";
                                    } else {
                                         echo "<br><div class='alert alert-dismissable alert-success' style='width: 70%!important; margin: 30px auto; text-align: center;'>
                                            <strong>Hemos recibido su consulta.</strong> Pronto nos pondremos en contacto. Muchas gracias. 
                                          </div>";
                                    }
                            } else{
                                echo 'Se ha devuelto el siguiente error:';
                                foreach ($respuesta->getErrorCodes() as $error_code) {
                                    echo '<tt>' . $error_code . '</tt> ';
                                }
                            }
                            

                        }
                ?>

                <div class="row formulario">
                    <form role="form" method="post" action="en-contacto.html">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <input class="form-control" id="nombre" name="nombre" type="text" placeholder="Nombre y Apellido" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="empresa" name="empresa" type="text" placeholder="Empresa">
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="telefono" name="telefono" type="text" placeholder="Teléfono">
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="email" name="email" type="email" placeholder="Email" required>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <textarea class="form-control" id="comentario" name="comentario" rows="6" type="text" placeholer="Mensaje" required> </textarea>
                            </div>

                            <div class="g-recaptcha" data-sitekey="6LelZScTAAAAAC2IsOM61ASKbMpPMGGq-BiXFh7R"></div>

                            <input id="submit_info_contact" name="submit_info_contact" type="submit" class="btn btn-info" value="Enviar">
                        </div>
                    </form>
                </div>

            </div>

            <div class="contenedorCV">
                <a href="mailto:busquedas@oxean.com.ar" class="btnCV">Déjanos tu CV</a>
            </div>
        </section>
        <!-- Fin Graficos -->

        <div class="clearfix"></div>
        <br><br>

        <!-- Cuerpo Seccion -->
        <section class="container contenidoSeccion">
            <div class="row paises">
                
                <div class="col-sm-6 col-md-4 col-lg-4 pais">
                    <img src="img/banderas/Brazil_flat.png" alt="Brasil"><br>
                    <span class="paisnombre">Brasil</span><br>
                    <span class="empresa">Grupo Oxean</span><br>
                    <a href="mailto:contacto@grupooxean.com">contacto@grupooxean.com</a>
                </div>

                <!--
                <div class="col-md-4 col-lg-4 pais">
                    <img src="img/banderas/Colombia_flat.png" alt="Colombia"><br>
                    <span class="paisnombre">Colombia</span><br>
                    <span class="empresa">Grupo Oxean</span><br>
                    <a href="mailto:info@grupooxean.com">info@grupooxean.com</a><br>
                </div>
                -->

                <div class="col-sm-6 col-md-4 col-lg-4 pais">
                    <img src="img/banderas/United-States_flat.png" alt="Estados Unidos"><br>
                    <span class="paisnombre">Estados Unidos</span><br>
                    <span class="empresa">Oxean Group</span><br>
                    <a href="mailto:carolina.doldan@oxeangroup.com">carolina.doldan@oxeangroup.com</a><br>
                </div>

                <!--
                <div class="col-sm-6 col-md-4 col-lg-4 pais">
                    <img src="img/banderas/Mexico_flat.png" alt="Mexico"><br>
                    <span class="paisnombre">México</span><br>
                    <span class="empresa">Oxean Más Manos</span><br>
                    <a href="mailto:gabriel@mas-manos.com.mx">gabriel@mas-manos.com.mx</a><br>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-4 pais">
                    <img src="img/banderas/Peru_flat.png" alt="Peru"><br>
                    <span class="paisnombre">Perú</span><br>
                    <span class="empresa">Grupo Oxean</span><br>
                    <a href="mailto:contacto@grupooxean.com">contacto@grupooxean.com</a><br>
                </div>
                -->

                <div class="col-sm-6 col-md-4 col-lg-4 pais">
                    <img src="img/banderas/Uruguay_flat.png" alt="Uruguay"><br>
                    <span class="paisnombre">Uruguay</span><br>
                    <span class="empresa">Grupo Oxean</span><br>
                    <a href="mailto:veronica.castro@oxean.com.uy">veronica.castro@oxean.com.uy</a><br>
                </div>

            </div>
        </section>
        <!-- Fin Cuerpo Seccion -->

        <div class="clearfix"></div>




<?php include_once("footer.php"); ?>
