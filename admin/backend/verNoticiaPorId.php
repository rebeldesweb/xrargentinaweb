<?php
    require 'config/config.php';
    $objRebelion = new Rebelion;
    $data = $objRebelion->verNoticiaPorId();
    echo $data;
?>