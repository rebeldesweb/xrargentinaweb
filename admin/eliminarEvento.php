<?php
    require 'config/config.php';
    $objRebelion = new Rebelion();
    $bool = $objRebelion->eliminarEvento();
    if ($bool){
        header('location: index.php?delete=1');
    }else{
        header('location: index.php?delete=2');
    }
?>