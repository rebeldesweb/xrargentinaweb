<?php
    require 'config/config.php';
    $colaborador = new Colaborador;
    $data = $colaborador->listarColaboradorPorTipo();
    echo $data;
?>