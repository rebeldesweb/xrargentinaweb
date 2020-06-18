<?php
    require '../classes/Conexion.php';
    require '../classes/CategoriaNoticia.php';
    $categoriaNoticia = new CategoriaNoticia;
    $data = $categoriaNoticia->modificarCategoria();
    echo $data;
?>