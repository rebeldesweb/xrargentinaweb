<?php 
    include 'includes/header.html';
    require 'classes/Conexion.php';
    require 'classes/Rebelion.php';
    $objRebelion = new Rebelion();
    $reg = $objRebelion->verEventoPorId();
?>

<article class="post-type-xr_event" id="post-6006">
    <div class="event-hero">
        <div class="event-hero__wrap container container--bottom0">
            <div class="event-hero__img">
                <img src="img/eventos/<?php echo $reg['imgEvento'] ?>" alt="" />
            </div>
        </div>
    </div>

    <div class="two-col-layout container event ">
        <div class="two-col-layout__right type type--small">
            <h1 class="page-title"><?php echo $reg['nombreEvento'] ?></h1>
            <div class="event-meta body-text-container">
                <div class="event-meta__wrap">
                    <div class="event-meta__item">
                        <div class="event-meta__heading">Cuando</div>
                            <div class="event_meta__body ">
                                <div class="event__time">
                                    <p><?php echo $reg['diaEventoInicial'] ?><br />
                                    <?php echo $reg['horarioInicialEvento'] ?> - <?php echo $reg['horarioFinalEvento'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="event-meta__item">
                            <div class="event-meta__heading">Donde</div>
                                <div class="event_meta__body">
                                    <p><?php echo $reg['lugarEvento'] ?></p>
                                </div>
                            </div>
                            <div class="event-meta__item">
                                <div class="event-meta__heading">Tipo</div>
                                    <div class="event_meta__body">
                                        <p>Acción, Actividad/Evento</p>
                                        <p>Acción, Actividad/Evento</p>
                                    </div>
                                </div>
                                <div class="event-meta__item">
                                    <div class="event-meta__heading">Alojado por</div>
                                        <div class="event_meta__body">
                                            <p>xrargentina.org</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <p>
                                   <?php echo $reg['descripcion'] ?> 
                                </p>
                            </div><!-- .container -->

                        <aside class="two-col-layout__left sidebar">
                            <h2 class="sidebar__title">ver también</h2>
                            <div class="events-widget-sidbar">
                                <div class="events-list">
                                    <ul class="item-list item-list--three" id="contenedorEvento">
                                        <!-- El contenido viene pintado desde comon/app.js -->
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div><!-- .events-widget-sidbar -->
                </div>
            </div>
        </div>
    </div>
</article>

<?php include 'includes/footer2.html';?>
<script src="comon/app.js"></script>