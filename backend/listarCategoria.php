<?php
    require '../classes/Conexion.php';
    require '../admin/backend/classes/CategoriaNoticia.php';
    $categoriaNoticia = new CategoriaNoticia;
    $data = $categoriaNoticia->listarCategorias();
    echo $data;
?>