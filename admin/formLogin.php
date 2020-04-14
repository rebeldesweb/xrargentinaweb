<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin Suscriptores</title>
  <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
  <link rel="stylesheet" href="comon/sweetalert2.css">
  <!-- <link rel="stylesheet" href="https://bootswatch.com/4/united/bootstrap.min.css"> -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <main class="container my-3">
    <h1>Formulario de ingreso</h1>

    <form class="form-group" action="login.php" method="post">
      Email:
      <input type="text" name="user" class="form-control"><br>
      Contraseña:
      <input type="password" name="pw" class="form-control"><br>
      <input type="submit" class="btn btn-success" value="Ingresar">
    </form>
<?php if (isset($_GET['login']) && $_GET['login']==false) {?>

    <script type="text/javascript">
    Swal.fire({
      type: 'error',
      title: 'Error',
      text: 'Nombre de usuario y/o clave incorrecta',
      confirmButtonColor: '#f44242'
    })
    </script>
<?php }elseif(isset($_GET['error']) && $_GET['error']==2){?>
    <script type="text/javascript">
    Swal.fire({
      type: 'error',
      title: 'Error',
      text: 'Para ver esta página debes iniciar sesión previamente!',
      confirmButtonColor: '#f44242'
    })
    </script>
<?php }?>
  </main>

<script src="comon/sweetalert2.js" charset="utf-8"></script>
