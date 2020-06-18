<?php 
    include 'includes/header.html';
    require 'classes/Conexion.php';
    require 'classes/Rebelion.php';
    $objRebelion = new Rebelion;
    $data = $objRebelion->verNoticiaPorId();
    $noticiaImagen = $data['noticiaImagen'];
?>
<main id="content" class="content-wrapper">
	<article class="post-type-post post" id="post-10671">
        <div class="two-col-layout container ">
            <div class="two-col-layout__right type type--small" id="noticiaCompleta">
                <div class="post_header">
                    <h1 class="page-title"><?php echo $data['titulo']; ?></h1>
                    <p class="post_date"><?php echo $data['fecha']; ?> Por <?php echo $data['autor']; ?></p>
                    <?php if ($noticiaImagen != 'noDisponible.jpg') {?>
                    <div class="post-hero">
                        <img src="img/noticias/<?php echo $data['noticiaImagen'] ?>" alt="">
                    </div>
                    <?php }; ?>
                </div>
                <div>
                    <?php if($data['link']!= null){
                        echo $data['link'];
                    }?>
                </div>
                <div class="contenidoNoticia">
                    <?php if ($data['noticia']!=null){
                        echo str_replace("\r", "<br/>", $data['noticia']);
                    }?>
                </div>
                <div class="slider" id="slider">
                    <div class="imagenGrande">
                        <?php if($data['noticiaImagen'] != 'noDisponible.jpg' && $data['noticiaImagen']!= null){?>
                            <img id="fotoGrande" src="http://xrargentina.org/img/noticias/<?php echo $data['noticiaImagen']?>"/>
                        <?php } ?>
                    </div>
                    <div class="foto-lista" id="foto-lista">
                        <img onclick="ampliarImagen(event)" src="http://xrargentina.org/img/noticias/<?php echo $data['noticiaImagen']?>"/>
                    </div>
                </div>
            </div>
            <aside class="two-col-layout__left sidebar sidebar--post">
                <div class="posts-widget-sidbar">
                    <h2 class="posts-widget-sidbar__title">articulos recientes</h2>
                    <ul id="noticias">
    
                    </ul>
                </div>
            </aside>
        </div><!-- .two-col-layout -->
    </article>
</main>             
                                    
<?php include 'includes/footer2.html';?>
<script src="comon/noticia.js"></script>
