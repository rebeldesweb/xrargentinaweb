<?php
    require 'config/config.php';
    $objRebelion = new Rebelion;
    $data = $objRebelion->listarNoticia();
    echo $data;
?>