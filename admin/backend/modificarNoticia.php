<?php
    require 'config/config.php';
    $objRebelion = new Rebelion;
    $data = $objRebelion->modificarNoticia();
    echo json_encode($data);
?>