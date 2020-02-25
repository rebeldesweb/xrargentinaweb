<?php
    require 'config/config.php';
    $actuar = new ActuarAhora;
    $data = $actuar->listarAccion();
    echo $data;
?>