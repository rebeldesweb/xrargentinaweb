<?php
    require 'config/config.php';
    $actuar = new ActuarAhora;
    $bool = $actuar->eliminarAccion();
    echo $bool;
?>