<?php
    require 'config/config.php';
    $objRebelion = new Rebelion;
    $bool = $objRebelion->agregarEvento();
    echo json_encode($bool);
?>