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



    //################# EVENTOS #################

    public function subirImagen(){
      $ruta = "../img/eventos/";
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

    public function eliminarEvento()
    {
      $id = $_POST['id'];
      $link = Conexion::conectar();
      $sql = "DELETE FROM eventos WHERE id = :id";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      if($stmt->execute()){
        return true;
      }
      return false;
    }
    
  }

?>
