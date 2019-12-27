<?php

  /**
   *
   */
  class Rebelion
  {

    //################# inscriptos #################

    public function agregarInscripto()
    {
      $link = Conexion::conectar();
      $nombre = $_POST['first-name'];
      $apellido = $_POST['last-name'];
      $telefono = $_POST['phone'];
      $cdgPostal = $_POST['postcode'];
      $email = $_POST['email'];
      $sql = "INSERT INTO inscriptos (nombre,apellido,telefono,codigoPostal,email)
                VALUES (:firstname, :lastname, :phone, :postcode, :email)";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':firstname', $nombre, PDO::PARAM_STR);
      $stmt->bindParam(':lastname', $apellido, PDO::PARAM_STR);
      $stmt->bindParam(':phone', $telefono, PDO::PARAM_INT);
      $stmt->bindParam(':postcode', $cdgPostal, PDO::PARAM_INT);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      if ($stmt->execute()) {
        return true;
      }
      return false;
    }


    public function listarInscripto()
    {
      $link = Conexion::conectar();
      $sql = "SELECT * FROM inscriptos ORDER BY id DESC";
      $stmt = $link->prepare($sql);
      $stmt->execute();
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $json = array();
      foreach ($resultado as $reg) {
        $json[] = array(
          'id' => $reg['id'],
          'nombre' => $reg['nombre'],
          'apellido' => $reg['apellido'],
          'telefono' => $reg['telefono'],
          'codigoPostal' => $reg['codigoPostal'],
          'email' => $reg['email'],
          'integracionOK' => $reg['integracionOK'],
          'ADNVOK' => $reg['ADNVOK'],
          'organizacion' => $reg['organizacion'],
          'notas' => $reg['notas'],
          'fecha' => $reg['fecha'],
          'sendEmail' => $reg['sendEmail']
        );
      }
      $jsonString = json_encode($json);
      return $jsonString;
    }

    public function verInscriptoPorId()
    {
      $id = $_POST['id'];
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
      $id = $_GET['id'];
      $link = Conexion::conectar();
      $sql = "DELETE FROM inscriptos WHERE id = :id";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_STR);
      if($stmt->execute()){
        return true;
      }
      return false;
    }

    public function modificarInscripto()
    {
      $id = $_POST['id'];
      $integracionOK = $_POST['integracionOK'];
      $ADNVOK = $_POST['ADNVOK'];
      $organizacion = $_POST['organizacion'];
      $notas = $_POST['notas'];
      $link = Conexion::conectar();
      $sql = "UPDATE inscriptos SET integracionOK = :integracionOK,
                                    ADNVOK = :ADNVOK,
                                    organizacion = :organizacion,
                                    notas = :notas
              WHERE id = :id";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':integracionOK', $integracionOK, PDO::PARAM_INT);
      $stmt->bindParam(':ADNVOK', $ADNVOK, PDO::PARAM_INT);
      $stmt->bindParam(':organizacion', $organizacion, PDO::PARAM_STR);
      $stmt->bindParam(':notas', $notas, PDO::PARAM_STR);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      if ($stmt->execute()) {
        return true;
      }
      return false;
    }

    public function searchInscripto()
    {
      $search = $_POST['inputSearch'];
      $link = Conexion::conectar();
      $sql = "SELECT * FROM inscriptos
              WHERE id LIKE '%$search%'
					    OR nombre LIKE '%$search%'
              OR apellido LIKE '%$search%'
              OR telefono LIKE '%$search%'
              OR codigoPostal LIKE '%$search%'
              OR email LIKE '%$search%'
              OR integracionOK LIKE '%$search%'
              OR ADNVOK LIKE '%$search%'
              OR organizacion LIKE '%$search%'
              OR notas LIKE '%$search%'
              OR fecha LIKE '%$search%'
              OR sendEmail LIKE '%$search%'";
      $stmt = $link->prepare($sql);
      $stmt->execute();
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $json = array();
      foreach ($resultado as $reg) {
        $json[] = array(
          'id' => $reg['id'],
          'nombre' => $reg['nombre'],
          'apellido' => $reg['apellido'],
          'telefono' => $reg['telefono'],
          'codigoPostal' => $reg['codigoPostal'],
          'email' => $reg['email'],
          'integracionOK' => $reg['integracionOK'],
          'ADNVOK' => $reg['ADNVOK'],
          'organizacion' => $reg['organizacion'],
          'notas' => $reg['notas'],
          'fecha' => $reg['fecha'],
          'sendEmail' => $reg['sendEmail']
        );
      }
      $jsonString = json_encode($json);
      return $jsonString;
    }



    //################# EVENTOS #################

    public function subirImagen(){
      $ruta = "../../img/eventos/";
      $imgEvento = 'noDisponible.jpg'; //fallback
      if (isset($_POST['imgEvento'])) {
        $imgEvento = $_POST['imgEvento'];
      }
      if ($_FILES['imgEvento']['error'] == 0) {
        $imgEventoTMP = $_FILES['imgEvento']['tmp_name'];
        $imgEvento = $_FILES['imgEvento']['name'];
        move_uploaded_file($imgEventoTMP,$ruta.$imgEvento);
      }
      return $imgEvento;
    }

    public function agregarEvento()
    {
      $link = Conexion::conectar();
      $diaEventoInicial = $_POST['diaEventoInicial'];
      $horarioInicialEvento = $_POST['horarioInicialEvento'];
      $diaEventoFinal = $_POST['diaEventoFinal'];
      $horarioFinalEvento = $_POST['horarioFinalEvento'];
      $nombreEvento = $_POST['nombreEvento'];
      $lugarEvento = $_POST['lugarEvento'];
      $descripcionEvento = $_POST['descripcion'];
      $imgEvento = $this->subirImagen();
      $numeroEvento = $_POST['numeroEvento'];
      $mesEvento = $_POST['mesEvento'];
      $sql = "INSERT INTO eventos (diaEventoInicial, horarioInicialEvento, diaEventoFinal, horarioFinalEvento,
                                  nombreEvento, lugarEvento, descripcion, imgEvento, numeroEvento, mesEvento)
              VALUES (:diaEventoInicial, :horarioInicialEvento, :diaEventoFinal, :horarioFinalEvento, :nombreEvento, :lugarEvento,
                      :descripcion, :imgEvento, :numeroEvento, :mesEvento)";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':diaEventoInicial', $diaEventoInicial, PDO::PARAM_STR);
      $stmt->bindParam(':horarioInicialEvento', $horarioInicialEvento, PDO::PARAM_STR);
      $stmt->bindParam(':diaEventoFinal', $diaEventoFinal, PDO::PARAM_STR);
      $stmt->bindParam(':horarioFinalEvento', $horarioFinalEvento, PDO::PARAM_STR);
      $stmt->bindParam(':nombreEvento', $nombreEvento, PDO::PARAM_STR);
      $stmt->bindParam(':lugarEvento', $lugarEvento, PDO::PARAM_STR);
      $stmt->bindParam(':descripcion', $descripcionEvento, PDO::PARAM_STR);
      $stmt->bindParam(':imgEvento', $imgEvento, PDO::PARAM_STR);
      $stmt->bindParam(':numeroEvento', $numeroEvento, PDO::PARAM_STR);
      $stmt->bindParam(':mesEvento', $mesEvento, PDO::PARAM_STR);
      if($stmt->execute()){
        return true;
      }
      return false;
    }

    public function modificarEvento()
    {
      $link = Conexion::conectar();
      $id = $_POST['id'];
      $diaEventoInicial = $_POST['diaEventoInicial'];
      $horarioInicialEvento = $_POST['horarioInicialEvento'];
      $diaEventoFinal = $_POST['diaEventoFinal'];
      $horarioFinalEvento = $_POST['horarioFinalEvento'];
      $nombreEvento = $_POST['nombreEvento'];
      $lugarEvento = $_POST['lugarEvento'];
      $descripcionEvento = $_POST['descripcion'];
      $imgEvento = $this->subirImagen();
      $numeroEvento = $_POST['numeroEvento'];
      $mesEvento = $_POST['mesEvento'];
      $sql = "UPDATE eventos SET diaEventoInicial = :diaEventoInicial,
                                  horarioInicialEvento = :horarioInicialEvento,
                                  diaEventoFinal = :diaEventoFinal,
                                  horarioFinalEvento = :horarioFinalEvento,
                                  nombreEvento = :nombreEvento,
                                  lugarEvento = :lugarEvento,
                                  descripcion = :descripcion,
                                  imgEvento = :imgEvento,
                                  numeroEvento = :numeroEvento,
                                  mesEvento = :mesEvento
              WHERE id = :id";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->bindParam(':diaEventoInicial', $diaEventoInicial, PDO::PARAM_STR);
      $stmt->bindParam(':horarioInicialEvento', $horarioInicialEvento, PDO::PARAM_STR);
      $stmt->bindParam(':diaEventoFinal', $diaEventoFinal, PDO::PARAM_STR);
      $stmt->bindParam(':horarioFinalEvento', $horarioFinalEvento, PDO::PARAM_STR);
      $stmt->bindParam(':nombreEvento', $nombreEvento, PDO::PARAM_STR);
      $stmt->bindParam(':lugarEvento', $lugarEvento, PDO::PARAM_STR);
      $stmt->bindParam(':descripcion', $descripcionEvento, PDO::PARAM_STR);
      $stmt->bindParam(':imgEvento', $imgEvento, PDO::PARAM_STR);
      $stmt->bindParam(':numeroEvento', $numeroEvento, PDO::PARAM_STR);
      $stmt->bindParam(':mesEvento', $mesEvento, PDO::PARAM_STR);
      if($stmt->execute()){
        return true;
      }
      return false;
    }

    public function listarEventos()
    {
      $link = Conexion::conectar();
      $sql = "SELECT * FROM eventos";
      $stmt = $link->prepare($sql);
      $stmt->execute();
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $json = array();
      foreach ($resultado as $reg) {
        $json[] = array(
          'id' => $reg['id'],
          'diaEventoInicial' => $reg['diaEventoInicial'],
          'horarioInicialEvento' => $reg['horarioInicialEvento'],
          'diaEventoFinal' => $reg['diaEventoFinal'],
          'horarioFinalEvento' => $reg['horarioFinalEvento'],
          'nombreEvento' => $reg['nombreEvento'],
          'lugarEvento' => $reg['lugarEvento'],
          'descripcion' => $reg['descripcion'],
          'imgEvento' => $reg['imgEvento'],
          'numeroEvento' => $reg['numeroEvento'],
          'mesEvento' => $reg['mesEvento']
        );
      }
      $jsonString = json_encode($json);
      return $jsonString;
    }

    public function verEventoPorId()
    {
      $id = $_GET['id'];
      $link = Conexion::conectar();
      $sql = "SELECT * FROM eventos WHERE id = :id";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $json = array();
      foreach ($resultado as $reg) {
        $json[] = array(
          'id' => $reg['id'],
          'diaEventoInicial' => $reg['diaEventoInicial'],
          'horarioInicialEvento' => $reg['horarioInicialEvento'],
          'diaEventoFinal' => $reg['diaEventoFinal'],
          'horarioFinalEvento' => $reg['horarioFinalEvento'],
          'nombreEvento' => $reg['nombreEvento'],
          'lugarEvento' => $reg['lugarEvento'],
          'descripcion' => $reg['descripcion'],
          'imgEvento' => $reg['imgEvento'],
          'numeroEvento' => $reg['numeroEvento'],
          'mesEvento' => $reg['mesEvento']
        );
      }
      $jsonString = json_encode($json);
      return $jsonString;
    }

    public function eliminarEvento()
    {
      $id = $_GET['id'];
      $link = Conexion::conectar();
      $sql = "DELETE FROM eventos WHERE id = :id";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      if($stmt->execute()){
        return true;
      }
      return false;
    }
    


    //################# NOTICIAS #################

    public function subirImagenNoticia(){
      // $ruta = "../img/noticias/";
      $ruta = "../../img/noticias/";
      $noticiaImagen = 'noDisponible.jpg'; //fallback
      if (isset($_POST['noticiaImagen'])) {
        $noticiaImagen = $_POST['noticiaImagen'];
      }
      if ($_FILES['noticiaImagen']['error'] == 0) {
        $noticiaImagenTMP = $_FILES['noticiaImagen']['tmp_name'];
        $noticiaImagen = $_FILES['noticiaImagen']['name'];
        $bool = move_uploaded_file($noticiaImagenTMP,$ruta.$noticiaImagen);
      }
      return $noticiaImagen;
      // return $_FILES['noticiaImagen']['name'];
      // return $noticiaImagen;
    }

    public function agregarNoticia()
    {
      $link = Conexion::conectar();
      $titulo = $_POST['titulo'];
      $fecha = $_POST['fecha'];
      $autor = $_POST['autor'];
      $noticiaImagen = $this->subirImagenNoticia();
      $noticia = $_POST['noticia'];
      $sql = "INSERT INTO noticias (titulo, fecha, autor, noticiaImagen, noticia)
              VALUES (:titulo, :fecha, :autor, :noticiaImagen, :noticia)";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
      $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
      $stmt->bindParam(':autor', $autor, PDO::PARAM_STR);
      $stmt->bindParam(':noticiaImagen', $noticiaImagen, PDO::PARAM_STR);
      $stmt->bindParam(':noticia', $noticia, PDO::PARAM_STR);
      if($stmt->execute()){
        return true;
      }
      return false;
    }

    public function modificarNoticia()
    {
      $link = Conexion::conectar();
      $id = $_POST['id'];
      $titulo = $_POST['titulo'];
      $fecha = $_POST['fecha'];
      $autor = $_POST['autor'];
      $noticiaImagen = $this->subirImagenNoticia();
      $noticia = $_POST['noticia'];
      $sql = "UPDATE noticias SET titulo = :titulo,
                                  fecha = :fecha,
                                  autor = :autor,
                                  noticiaImagen = :noticiaImagen,
                                  noticia = :noticia
              WHERE id = :id";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
      $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
      $stmt->bindParam(':autor', $autor, PDO::PARAM_STR);
      $stmt->bindParam(':noticiaImagen', $noticiaImagen, PDO::PARAM_STR);
      $stmt->bindParam(':noticia', $noticia, PDO::PARAM_STR);
      if($stmt->execute()){
        return true;
      }
      return false;
    }

    public function listarNoticia()
    {
      $link = Conexion::conectar();
      $sql = "SELECT * FROM noticias";
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
          'noticia' => $reg['noticia']
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
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $json = array();
      foreach ($resultado as $reg) {
        $json[] = array(
          'id' => $reg['id'],
          'titulo' => $reg['titulo'],
          'fecha' => $reg['fecha'],
          'autor' => $reg['autor'],
          'noticiaImagen' => $reg['noticiaImagen'],
          'noticia' => $reg['noticia']
        );
      }
      $jsonString = json_encode($json);
      return $jsonString;
    }

    public function eliminarNoticia()
    {
      $id = $_GET['id'];
      $link = Conexion::conectar();
      $sql = "DELETE FROM noticias WHERE id = :id";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      if($stmt->execute()){
        return true;
      }
      return false;
    }    

  }

?>
