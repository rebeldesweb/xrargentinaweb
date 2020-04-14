<?php
    require 'config/config.php';
    $objRebelion = new Rebelion();
    $bool = $objRebelion->eliminarEvento();
    if ($bool){
        header('location: admin.php?delete=1');
    }else{
        header('location: admin.php?delete=2');
    }
?>