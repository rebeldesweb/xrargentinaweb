<?php

  /**
   *
   */
  class Rebelion
  {
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

  }

?>
