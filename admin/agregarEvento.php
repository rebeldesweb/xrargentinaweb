<?php
    require 'config/config.php';
    $objRebelion = new Rebelion();
    $bool = $objRebelion->agregarEvento();
    if($bool){
        header('location: adminEventos.php?event=true');
    }    
?>