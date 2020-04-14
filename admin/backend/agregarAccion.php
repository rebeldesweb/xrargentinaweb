<?php
    require 'config/config.php';
    $actuar = new ActuarAhora;
    $bool = $actuar->agregarAccion();
    echo $bool;
?>