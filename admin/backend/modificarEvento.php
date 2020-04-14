<?php
    require 'config/config.php';
    $objRebelion = new Rebelion;
    $bool = $objRebelion->modificarEvento();
    if ($bool) {
        echo json_encode('true');
    }else{
        echo json_encode('false');
    }
?>