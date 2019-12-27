<?php
    require 'config/config.php';
    $objRebelion = new Rebelion;
    $data = $objRebelion->eliminarNoticia();
    echo json_encode($data);
?>