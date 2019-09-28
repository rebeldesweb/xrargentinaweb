<?php
  require 'config/config.php';
  $objRebelion = new Rebelion();
  $reg = $objRebelion->listarEventos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin Eventos</title>
  <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://bootswatch.com/4/united/bootstrap.min.css"> -->
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../comon/sweetalert2.css">
</head>
<body>
  <nav class="navbar navbar-light bg-light">
    <a href="index.php" class="navbar-brand">Lista de eventos</a>
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
  <div class="contenedor-admin my-3">
    <div class="col-12">
      <table class="table table-bordered table-sm">
        <thead>
          <tr>
            <td class="text-center">NOMBRE EVENTO</td>
            <td class="text-center">LUGAR</td>
            <td class="text-center">EMPIEZA</td>
            <td class="text-center">HOARIO DE INICIO</td>
            <td class="text-center">TERMINA</td>
            <td class="text-center">MES</td>
          </tr>
        </thead>
        <tbody id="tasks">
          <?php foreach ($reg as $res){?>
            <tr>
              <td class="text-center"><?php echo $res['nombreEvento'] ?></td>
              <td class="text-center"><?php echo $res['lugarEvento'] ?></td>
              <td class="text-center"><?php echo $res['diaEventoInicial'] ?></td>
              <td class="text-center"><?php echo $res['horarioInicialEvento'] ?></td>
              <td class="text-center"><?php echo $res['diaEventoFinal'] ?></td>
              <td class="text-center"><?php echo $res['mesEvento'] ?></td>
              <td class="text-center">
                <a target="blank" id="btn-eliminar" href="formEliminarEvento.php?id=<?php echo $res['id'];?>" class="btn btn-danger">Eliminar</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="../comon/sweetalert2.js" charset="utf-8"></script>
</body>
</html>
