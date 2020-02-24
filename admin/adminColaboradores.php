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
  <title>Admin Colaboradores</title>
  <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://bootswatch.com/4/united/bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="../css/style.css"> -->
  <link rel="stylesheet" href="../comon/sweetalert2.css">
</head>
<body>
  <nav class="navbar navbar-light bg-light">
    <a href="index.php" class="navbar-brand">Colaboradores</a>
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
  <div class="container mt-4" id="optionBody">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            Colaboración
          </div>
          <div class="card-body">
            <h5 class="card-title">Equipos de trabajo</h5>
            <p class="card-text">Ver los inscriptos que se ofrecieron</p>
            <a href="#" onclick="getInscriptos('Colaborar en equipos de trabajo')" class="btn btn-primary">Ver listado</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <div class="card-header">
            Colaboración
          </div>
          <div class="card-body">
            <h5 class="card-title">Acciones no violentas</h5>
            <p class="card-text">Ver los inscriptos que se ofrecieron</p>
            <a href="#" onclick="getInscriptos('Colaborar en acciones no violentas')" class="btn btn-primary">Ver listado</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <div class="card-header">
            Colaboración
          </div>
          <div class="card-body">
            <h5 class="card-title">Grupos locales</h5>
            <p class="card-text">Ver los inscriptos que se ofrecieron.</p>
            <a href="#" onclick="getInscriptos('Sumarme a grupo local')" class="btn btn-primary">Ver listado</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <div class="card-header">
            Colaboración
          </div>
          <div class="card-body">
            <h5 class="card-title">Redes sociales</h5>
            <p class="card-text">Ver los inscriptos que se ofrecieron.</p>
            <a href="#" onclick="getInscriptos('Compartiendo en redes sociales')" class="btn btn-primary">Ver listado</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="contenedor-admin my-3 d-none" id="tablaInscriptos">
    <div class="col-12">
      <button id="btnBack" class="btn btn-warning mb-3">Volver a las opciones</button>
      <div id="reporting"></div>
      <table class="table table-bordered table-sm" id="table">
        <thead>
          <tr>
            <!-- <td class="text-center">ID</td> -->
            <td class="text-center">NOMBRE</td>
            <td class="text-center">APELLIDO</td>
            <td class="text-center">EMAIL</td>
            <td class="text-center">COLABORACIÓN</td>
          </tr>
        </thead>
        <tbody id="inscriptos">
          
        </tbody>
      </table>
    </div>
  </div>

  






  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="../comon/sweetalert2.js" charset="utf-8"></script>
  <script src="js/main.js"></script>
  <script src="js/colaboradores.js"></script>
</body>
</html>