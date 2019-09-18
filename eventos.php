<?php include 'includes/header.html'; ?>

<div class="hero ">
    <picture>
        <source srcset="https://rebellion.earth/wp/wp-content/uploads/2019/07/Events-top-banner-image-2048x650.jpg" media="(min-width: 1001px)">
        <source srcset="https://rebellion.earth/wp/wp-content/uploads/2019/07/Events-top-banner-image-1000x415.jpg" media="(min-width: 601px)">
        <img src="https://rebellion.earth/wp/wp-content/uploads/2019/07/Events-top-banner-image-600x300.jpg" alt="" />
    </picture>
    <h1>Eventos</h1>
</div>

<div class="type body-text container container--bottom0">
    <div class="featured-text">
        <div class="featured-text__content">
            <p>Estamos organizando más charlas, más entrenamientos y muchas más acciones</p>
            <p>Están todxs invitados a sumarse</p>
        </div>
    </div>
</div>

<div class="events-widget container events-widget--home">
    <div class="events-list">
        <ul class="item-list item-list--three" id="contenedorEvento">
            <!-- caja del evento -->
            <!-- ATENCION: VIENE PINTADO DESDE EL ARCHIVO comon/APP.JS -->
        </ul>
    </div>
</div>



<?php
    include 'includes/footer2.html';
?>
<script src="comon/app.js"></script>