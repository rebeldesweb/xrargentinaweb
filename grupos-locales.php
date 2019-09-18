<?php include 'includes/header.html' ?>

<div class="hero ">
    <picture>
        <source srcset="https://rebellion.earth/wp/wp-content/uploads/2019/03/LocalGroups-Bannerimage.jpg" media="(min-width: 1001px)">
        <source srcset="https://rebellion.earth/wp/wp-content/uploads/2019/03/LocalGroups-Bannerimage-1000x415.jpg" media="(min-width: 601px)">
        <img src="https://rebellion.earth/wp/wp-content/uploads/2019/03/LocalGroups-Bannerimage-600x300.jpg" alt="" />
    </picture>
    <h1>Grupos locales</h1>
</div>


<div class="type body-text container container--bottom0">
    <div class="featured-text">
        <div class="featured-text__content">
            <p>¿Quieres involucrarte? Consulte el mapa a continuación para encontrar un grupo de rebelión de extinción cerca de usted. Si no puede encontrar lo que está buscando, consulte nuestra sección de <a target="blank" href="https://rebellion.earth/act-now/resources/communities/">Recursos</a> para obtener información sobre cómo comenzar su propio grupo y <a href="https://forms.organise.earth/index.php?r=survey/index&amp;sid=632398&amp;lang=en">obtenerlo en el mapa</a>.</p> 
        </div>
    </div>
</div>

  <!-- ************************************************** -->
  <!-- map decision is made in local-group-map.js -->
  <!-- ************************************************** -->

  <!-- google api maps dynamic -->
  <div class="api-map">

    <div class="map-search container">
      <h2>Find A Group</h2>
      <form action="https://rebellion.earth/act-now/local-groups/#map-search" class="form">
        <div class="map-search-form__wrap">
          <div class="form__group">
            <label for="event-filter-from" class="is-hidden-visually">Local Groups Map Search</label>
            <input type="text" name="map-search-txt" id="map-search__input" placeholder="Search by country, postcode or place"/>
            <button type="button" name="" id="map-search__button"/>
          </div>
          <div class="form__group">
            <label for="event-filter-from" class="is-hidden-visually">Find My Location Button</label>
            <button type="button" id='find-my-location' name="find-my-location" class='btn btn--primary-blue'>FIND MY LOCATION</button>
          </div>
          <div class="form__group">
            <label for="event-filter-from" class="is-hidden-visually">View All Places Button</label>
            <button id='view-all-places' class='btn btn--primary-blue' type="button" name="view-all-places">VIEW ALL PLACES</button>
          </div>
        </div>
      </form>
    </div>
    <div id="map-canvas"></div>
  </div>

  <!-- google maps embed -->
  <div class="embed-map">
    <iframe id='map--embed' src="https://www.google.com/maps/d/embed?mid=11jUqqjTHMThksd4KbvGGzb3I3Cr3PkBl" width="640" height="480"></iframe>
  </div>
</article>



<?php include 'includes/footer2.html' ?>