        <!-- Footer -->
        <footer class="fluid-container">

        <?php
            if ($cat >= 0) {
                echo '<!-- Inicio Google Maps -->
                    <div class="mapContainer">
                        <div id="map_canvas"></div>
                    </div>
                    <!-- Fin Google Maps -->';
            }
        ?>
            


            <div class="container">
                <br><br>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 marcaFooter">
                        <img src="<?php echo URL;?>/img/oxean_invertida.png" alt="Grupo Oxean :: Comunicación Cross :: Comunicación Interna :: Comunicación Externa :: Consultoría">
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1">
                            <img src="<?php echo URL;?>/img/banderas/Argentina_flat.png" width="24" alt="Argentina">
                        </div>
                        <div class="col-xs-12 col-sm-7 col-md-6 col-lg-6">
                            Argentina - Buenos Aires<br>
                            <span class="empresa">Grupo Oxean</span><br>
                            contacto@grupooxean.com<br>
                            Av. del Libertador 6250 5 Piso<br>
                            C1428 - Belgrano - CABA<br>
                            Tel: (+54 11) 4788 8699<br>
                            <a href="http://oxean.com.br" target=0><img src="<?php echo URL;?>/img/banderas/Brazil_flat.png" width="24" alt="Brasil"></a>
                            <!--<a href="<?php echo URL;?>/en-contacto-colombia.php"><img src="<?php echo URL;?>/img/banderas/Colombia_flat.png" width="24" alt="Colombia"></a>-->
                            <a href="http://oxeangroup.com" target=0><img src="<?php echo URL;?>/img/banderas/United-States_flat.png" width="24" alt="Estados Unidos"></a>
                            <!--<a href="http://mas-manos.com.mx" target=0><img src="<?php echo URL;?>/img/banderas/Mexico_flat.png" width="24" alt="Mexico"></a>
                            <a href="<?php echo URL;?>/en-contacto-peru.php"><img src="<?php echo URL;?>/img/banderas/Peru_flat.png" width="24" alt="Peru"></a>-->
                            <a href="http://oxean.com.uy" target=0><img src="<?php echo URL;?>/img/banderas/Uruguay_flat.png" width="24" alt="Uruguay"></a>
                        </div>

                        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 social">
                            <a href="https://www.facebook.com/oxean" alt="Facebook" target=0><i class="fa fa-facebook"></i></a>
                            <a href="https://twitter.com/GrupoOxean" alt="Twitter" target=0><i class="fa fa-twitter"></i></a>
                            <!--<a href="" alt="Google+" target=0><i class="fa fa-google-plus"></i></a>-->
                             
                            <a href="https://www.youtube.com/user/grupooxean" alt="YouTube" target=0><i class="fa fa-youtube"></i></a>
                            <a href="https://www.linkedin.com/company/grupo-oxean-s-a-" alt="Linkedin" target=0><i class="fa fa-linkedin"></i></a>
                            <a href="http://grupooxean.com/wordpress/" alt="Blog" target=0><i class="fa fa-wordpress"></i></a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="legales">
                Copyright 2016 -  Grupo Oxean S.A. - www.grupooxean.com - contacto@grupooxean.com
            </div>
        </footer>
        <!-- Fin Footer -->


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo URL;?>/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="<?php echo URL;?>/js/bootstrap.js"></script>
        <script src="<?php echo URL;?>/js/jquery.fancybox.js"></script>
        <script type="text/javascript" src="<?php echo URL;?>/js/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
        <script src="<?php echo URL;?>/js/jquery.royalslider-min.js"></script>
        <script src="<?php echo URL;?>/js/plugins.js"></script>
        <script src="<?php echo URL;?>/js/main.js"></script>

        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-63109322-1', 'auto');
          ga('send', 'pageview');

        </script>
    </body>
</html>