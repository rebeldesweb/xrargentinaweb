<?php
    require 'config/config.php';
    $actuar = new ActuarAhora;
    $data = $actuar->verAccionPorId();
    echo $data;
?>