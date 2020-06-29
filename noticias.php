<?php include 'includes/header.html' ?>
<main id="content" class="content-wrapper">
		    
    <div class="news">
        <div class="two-col-layout container" data-remote-form-content="posts" style="justify-content:center">
            <div class="two-col-layout__right">
                <h4 class='news__title' id="titulo-seccion">Todas las noticias</h4>
                <div class="posts__grid js-masonry-grid" id="noticias" data-found-posts="">
                    <!-- noticias -->
                </div>
            </div>
            <div class="two-col-layout__left">
                <div class="nav-main-sub__sidebar">
                    <h2>Categorías</h2>
                    <ul id="categorias">
			            <li class=" menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-14 current_page_item current_page_parent menu-item-7994">
			                 <a target="" onclick="getNoticias()" data-menuanchor="https://rebellion.earth/news/">Todas</a>
		                </li>
	                </ul>
                </div>
            </div>
        </div>
    </div>
</main>          

                                    
<?php include 'includes/footer2.html';?>
<script src="comon/noticias.js"></script>
