<?php
  /**
   *
   */
  class Usuario
  {
    public function login()
    {
      $user = $_POST['user'];
      $pw = $_POST['pw'];
      $link = Conexion::conectar();
      $sql = "SELECT user
                FROM usuarios
                  WHERE user = :user
                  AND pw = :pw";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':user', $user, PDO::PARAM_STR);
      $stmt->bindParam(':pw', $pw, PDO::PARAM_STR);
      $stmt->execute();
      $cantidad = $stmt->rowCount();
      if ($cantidad==0) {
        header('location: formLogin.php?login=false');
      }else {
        $_SESSION['login']=1;
        $_SESSION['usuName'] = $user;
        header('location: admin.php');
      }
    }

    public function logout()
    {
      session_unset(); //limpia las variables de session
      session_destroy(); //borra la sesion
      header('refresh:3; url=formLogin.php');
    }

  }


?>
