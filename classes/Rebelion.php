<?php

  /**
   *
   */
  class Rebelion
  {

    public function listarProvincias()
    {
      $link = Conexion::conectar();
      $sql = "SELECT * FROM provincia";
      $stmt = $link->prepare($sql);
      $stmt->execute();
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $json[] = array();
      foreach ($resultado as $reg) {
        $json[] = array(
          'idProvincia' => $reg['idProvincia'],
          'provinciaNombre' => $reg['provinciaNombre']
        );
      }
      $jsonString = json_encode($json);
      return $jsonString;
    }

    public function listarCiudades()
    {
      $link = Conexion::conectar();
      $idProvincia = $_GET['idProvincia'];
      $sql = "SELECT * FROM ciudades WHERE idProvincia = :idProvincia";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':idProvincia',$idProvincia,PDO::PARAM_INT);
      $stmt->execute();
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $json = array();
      foreach ($resultado as $reg) {
        $json[] = array(
          'idCiudad' => $reg['idCiudad'],
          'idProvincia' => $reg['idProvincia'],
          'ciudadNombre' => $reg['ciudadNombre']
        );
      }
      $jsonString = json_encode($json);
      return $jsonString;
    }

    public function agregarInscripto()
    {
      $link = Conexion::conectar();
      $nombre = $_POST['first-name'];
      $apellido = $_POST['last-name'];
      $telefono = $_POST['phone'];
      $provincia = $_POST['provincia'];
      $ciudad = $_POST['ciudad'];
      $email = $_POST['email'];
      $fecha = $_POST['fecha'];
      $colaboracion = $_POST['colaboracion'];
      $grupoLocal = $_POST['grupo-local'];
      //previamente obtenemos los email que coincidad con el email que ingreso el usuario, para que no se inscriban muchos con el mismo email
      $queryPrevious = "SELECT email FROM inscriptos WHERE email = :email";
      $stmt = $link->prepare($queryPrevious);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->execute();
      $cantidad = $stmt->rowCount();
      if ($cantidad>=1) {
        header('location: index.html?duplicate');
      }else {
        $sql = "INSERT INTO inscriptos (nombre,apellido,telefono,provincia,ciudad,email,fecha,grupoLocal,estado)
                VALUES (:firstname, :lastname, :phone, :provincia, :ciudad, :email, :fecha, :grupoLocal,1)";
        $stmt = $link->prepare($sql);
        $stmt->bindParam(':firstname', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $apellido, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $telefono, PDO::PARAM_INT);
        $stmt->bindParam(':provincia', $provincia, PDO::PARAM_INT);
        $stmt->bindParam(':ciudad', $ciudad, PDO::PARAM_INT);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $stmt->bindParam(':grupoLocal', $grupoLocal, PDO::PARAM_STR);
        // $stmt->bindParam(':colaboracion', $colaboracion, PDO::PARAM_STR);
        if ($stmt->execute()) {
          if ($colaboracion != "") {
            if (is_array($colaboracion)) {
              $querySecond = "SELECT id FROM inscriptos WHERE email = '".$email."'";
              $stmt = $link->prepare($querySecond);
              $stmt->execute();
              $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
              foreach ($data as $reg) {
                $id = $reg['id'];
              }
              for ($i=0; $i < count($colaboracion); $i++) { 
                $tipoColaboracion = $colaboracion[$i];
                $sql = "INSERT INTO colaboracion (idInscripto,colaboracion) VALUES (".$id.",'".$tipoColaboracion."')";
                $stmt = $link->prepare($sql);
                $bool = $stmt->execute();
              }
              if ($bool) {
                return true;
              }
            }
          }
        }
        return false; 
      }
    }

    //esta funcion lo que hace es obtener el id del nuevo suscriptor para luego dejar el log de si recibió el email o no.
    public function getIdEmail()
    {
      $link = Conexion::conectar();
      $email = $_POST['email'];
      $sql = "SELECT id FROM inscriptos WHERE email = '". $email ."'";
      $stmt = $link->prepare($sql);
      $stmt->execute();
      $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
      return $resultado['id'];
    }

    //esta funcion recibe el id que lo obtiene la funcion getIdEmail, y gracias a el modifico el valor de la columna sendEmail de la tabla inscriptos.
    public function logEmail($callback)
    {
      $link = Conexion::conectar();
      $id = $callback;
      $sql = "UPDATE inscriptos SET sendEmail = 1 WHERE id = :id";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      if ($stmt->execute()) {
        return true;
      }
      return false;
    }


    public function listarInscripto()
    {
      $link = Conexion::conectar();
      $sql = "SELECT * FROM inscriptos";
      $stmt = $link->prepare($sql);
      $stmt->execute();
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $resultado;
    }

    public function verInscriptoPorId()
    {
      $id = $_GET['id'];
      $link = Conexion::conectar();
      $sql = "SELECT * FROM inscriptos WHERE id = :id";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_STR);
      $stmt->execute();
      $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
      return $resultado;
    }

    public function eliminarInscripto()
    {
      $id = $_POST['id'];
      $link = Conexion::conectar();
      $sql = "DELETE FROM inscriptos WHERE id = :id";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_STR);
      if($stmt->execute()){
        return true;
      }
      return false;
    }

    // eventos

    public function listarEventos()
    {
      $link = Conexion::conectar();
      $sql = "SELECT * FROM eventos";
      $stmt = $link->prepare($sql);
      $stmt->execute();
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $resultado;
    }

    public function verEventoPorId()
    {
      $id = $_GET['id'];
      $link = Conexion::conectar();
      $sql = "SELECT * FROM eventos WHERE id = :id";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
      return $resultado;
    }

    public function listarNoticia()
    {
      $link = Conexion::conectar();
      $sql = "SELECT * FROM noticias ORDER BY id DESC";
      $stmt = $link->prepare($sql);
      $stmt->execute();
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $json = array();
      foreach ($resultado as $reg) {
        $json[] = array(
          'id' => $reg['id'],
          'titulo' => $reg['titulo'],
          'fecha' => $reg['fecha'],
          'autor' => $reg['autor'],
          'noticiaImagen' => $reg['noticiaImagen'],
          'noticia' => $reg['noticia'],
          'link' => $reg['link']
        );
      }
      $jsonString = json_encode($json);
      return $jsonString;
    }

    public function verNoticiaPorId()
    {
      $id = $_GET['id'];
      $link = Conexion::conectar();
      $sql = "SELECT * FROM noticias WHERE id = :id";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
      // $json = array();
      // foreach ($resultado as $reg) {
      //   $json[] = array(
      //     'id' => $reg['id'],
      //     'titulo' => $reg['titulo'],
      //     'fecha' => $reg['fecha'],
      //     'autor' => $reg['autor'],
      //     'noticiaImagen' => $reg['noticiaImagen'],
      //     'noticia' => $reg['noticia']
      //   );
      // }
      // $jsonString = json_encode($json);
      return $resultado;
    }

    public function verImagenesPorNoticia()
    {
      $id = $_GET['id'];
      $link = Conexion::conectar();
      $sql = "SELECT * FROM imagenesNoticia WHERE idNoticia = ".$id;
      $stmt = $link->prepare($sql);
      $stmt->execute();
      if($stmt->execute()){
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = array();
        foreach ($resultado as $reg) {
          $json[] = array(
            'idImagen' => $reg['idImagen'],
            'idNoticia' => $reg['idNoticia'],
            'imagen' => $reg['imagen']
          );
        };
        $jsonString = json_encode($json);
        return $jsonString;
      }
    }

    public function listarNoticiaPorCategoria()
    {
      $idCategoria = $_GET['idCategoria'];
      $link = Conexion::conectar();
      $sql = "SELECT id,titulo,fecha,autor,noticiaImagen,noticia,categoria 
                FROM noticias AS N, categoriasNoticia AS C
                  WHERE N.idCategoria = C.idCategoria AND N.idCategoria = :idCategoria ORDER BY id DESC";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':idCategoria',$idCategoria,PDO::PARAM_INT);
      $stmt->execute();
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $json = array();
      foreach ($resultado as $reg) {
        $json[] = array(
          'id' => $reg['id'],
          'titulo' => $reg['titulo'],
          'fecha' => $reg['fecha'],
          'autor' => $reg['autor'],
          'noticiaImagen' => $reg['noticiaImagen'],
          'noticia' => $reg['noticia'],
          'categoria' => $reg['categoria'],
          'link' => $reg['link']
        );
      }
      $jsonString = json_encode($json);
      return $jsonString;
    }


  }

?>
