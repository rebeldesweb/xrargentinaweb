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
  }

?>
