<?php
    require 'config/config.php';
    $objRebelion = new Rebelion;
    $data = $objRebelion->agregarNoticia();
    echo json_encode($data);
?>