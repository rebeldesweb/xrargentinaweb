<?php
    require 'config/config.php';
    $colaborador = new Colaborador;
    $data = $colaborador->listarColaboradorPorTipo();
    // echo $_GET['tipo'];
    echo $data;
?>