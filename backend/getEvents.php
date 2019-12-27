<?php
    
    $conexion = mysqli_connect('localhost', 'root', '', 'xr_argentina');
    mysqli_set_charset($conexion,'utf8');
    
    $sql = "SELECT * FROM eventos ORDER BY id DESC LIMIT 3";

    $listado = mysqli_query($conexion,$sql);

    while($row = mysqli_fetch_assoc($listado)){
        $json[] = array(
          'id' => $row['id'],
          'diaEventoInicial' => $row['diaEventoInicial'],
          'horarioInicialEvento' => $row['horarioInicialEvento'],
          'diaEventoFinal' => $row['diaEventoFinal'],
          'horarioFinalEvento' => $row['horarioFinalEvento'],
          'nombreEvento' => $row['nombreEvento'],
          'lugarEvento' => $row['lugarEvento'],
          'descripcion' => $row['descripcion'],
          'imgEvento' => $row['imgEvento'],
          'numeroEvento' => $row['numeroEvento'],
          'mesEvento' => $row['mesEvento']
        );
      }
    
      $jsonString = json_encode($json);
      echo $jsonString;
?>