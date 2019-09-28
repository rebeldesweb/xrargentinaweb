<?php
  require 'config/config.php';
  $objRebelion = new Rebelion();
  $reg = $objRebelion->listarInscripto();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin Suscriptores</title>
  <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://bootswatch.com/4/united/bootstrap.min.css"> -->
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../comon/sweetalert2.css">
</head>
<body>
  <nav class="navbar navbar-light bg-light">
    <a href="index.php" class="navbar-brand">Admin eventos</a>
    <form class="form-inline">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $_SESSION['usuName'];?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="logout.php">Cerrar sesión</a>
          </div>
      </li>
      <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
    </form>
  </nav>
  <div class="container mt-3">
    <a class="btn btn-warning" href="index.php">Regresar al panel de control</a>
    <h2 class="mt-2">Formulario de alta de un nuevo evento</h2>
    <form action="agregarEvento.php" class="form-group" method="post"  enctype="multipart/form-data">
        <br>
        Desde:
        <input type="text" name="diaEventoInicial" placeholder="Ingrese fecha del evento. Ej: 30.08.2019" class="form-control mt-3" required>
        <input type="text" name="horarioInicialEvento" placeholder="Horario de inicio" class="form-control mt-3" required>
        <br>
        Hasta:
        <input type="text" name="diaEventoFinal" placeholder="Ingrese fecha del evento. Ej: 30.08.2019" class="form-control mt-3" required>
        <input type="text" name="horarioFinalEvento" placeholder="Horario de cierre" class="form-control mt-3" required>
        <hr>
        <input type="text" name="nombreEvento" placeholder="Nombre del evento" class="form-control mt-3" required>
        <input type="text" name="lugarEvento" placeholder="Lugar del evento" class="form-control mt-3" required>
        <textarea name="descripcion" class="form-control mt-3" placeholder="Describa el evento" cols="30" rows="10" required></textarea>
        <label class="mt-3">Cargue la foto del evento:</label>
        <input type="file" name="imgEvento" class="mt-1"/>
        <input type="text" name="numeroEvento" class="form-control mt-3" placeholder="Ingrese fecha numérica del evento. ej: 03" required>
        <input type="text" name="mesEvento" class="form-control mt-3" placeholder="Ingrese el mes del evento" required>
        <br>
        <center>
            <input type="submit" class="btn btn-info mt-3" value="Agregar Evento">
        </center>
    </form>
  </div>
  

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="../comon/sweetalert2.js" charset="utf-8"></script>
  <?php
    if(isset($_GET['event'])){?>
        <script>
            Swal.fire({
            position: 'top-end',
            type: 'success',
            title: 'Evento agregado',
            showConfirmButton: false,
            timer: 2500
            })
        </script>
  <?php }?>
</body>
</html>