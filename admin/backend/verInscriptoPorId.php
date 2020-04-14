<?php
    require 'config/config.php';
    $objRebelion = new Rebelion;
    $data = $objRebelion->searchInscripto();
    echo $data;
?>