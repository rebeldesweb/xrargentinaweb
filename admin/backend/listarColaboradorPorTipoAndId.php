<?php
    require 'config/config.php';
    $colaborador = new Colaborador;
    $data = $colaborador->listarColaboradorPorTipoAndId();
    // echo $_GET['tipo'];
    // print_r($data)
    echo $data;
?>