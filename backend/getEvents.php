<?php
    
    $conexion = mysqli_connect('69.175.67.50', 'laciudad_xrargentina', 'Rebeldesarg1', 'laciudad_xrargentina');
    mysqli_set_charset($conexion,'utf8');
    
    $sql = "SELECT * FROM eventos ORDER BY id DESC";

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