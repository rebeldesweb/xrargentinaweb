<?php
    require 'config/config.php';
    $colaborador = new Colaborador;
    $data = $colaborador->modificarColaborador();
    echo $data;
?>