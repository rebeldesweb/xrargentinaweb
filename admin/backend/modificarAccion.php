<?php
    require 'config/config.php';
    $actuar = new ActuarAhora;
    $bool = $actuar->modificarAccion();
    echo $bool;
?>