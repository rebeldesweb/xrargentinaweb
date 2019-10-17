<?php
  require 'config/config.php';
  $objRebelion = new Rebelion();
  $reg = $objRebelion->searchInscripto();
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
    <a href="index.php" class="navbar-brand">Lista de suscriptores</a>
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
  <br>

  <div class="row">
    <div class="col-12">
      <div class="contenedorForm text-left d-flex justify-content-end mr-3">
        <form action="inscriptoSearch.php" id="formSearch" method="GET" class="form-inline">
          <input type="text" name="inputSearch" class="form-control" placeholder="Filtre inscripto por acá">
          <input type="submit" class="btn btn-info" value="Buscar">
        </form>
      </div>
    </div>
  </div>

  <div class="contenedor-admin my-3">

    <div class="col-12">
    <div id="reporting"></div>
      <table class="table table-bordered table-sm">
        <thead>
          <tr>
            <td class="text-center">ID</td>
            <td class="text-center">NOMBRE</td>
            <td class="text-center">APELLIDO</td>
            <!-- <td class="text-center">TELEFONO</td>
            <td class="text-center">CÓDIGO POSTAL</td> -->
            <td class="text-center">EMAIL</td>
            <td class="text-center">INTEGRACIONOK</td>
            <td class="text-center">ADNVOK</td>
            <td class="text-center">ORGANIZACIÓN</td>
            <td class="text-center">NOTAS</td>
            <td class="text-center">FECHA</td>
          </tr>
        </thead>
        <tbody id="tasks">
          <?php foreach ($reg as $res){?>
            <tr>
              <td class="text-center"><?php echo $res['id'] ?></td>
              <td class="text-center"><?php echo $res['nombre'] ?></td>
              <td class="text-center"><?php echo $res['apellido'] ?></td>
              <!-- <td class="text-center"><?php echo $res['telefono'] ?></td>
              <td class="text-center"><?php echo $res['codigoPostal'] ?></td> -->
              <td class="text-center"><?php echo $res['email'] ?></td>
              <td class="text-center"><?php echo $res['integracionOK'] ?></td>
              <td class="text-center"><?php echo $res['ADNVOK'] ?></td>
              <td class="text-center"><?php echo $res['organizacion'] ?></td>
              <td class="text-center"><?php echo $res['notas'] ?></td>
              <td class="text-center"><?php echo $res['fecha'] ?></td>
              <td class="text-center">
                <a target="blank" id="btn-eliminar" href="form-delete.php?id=<?php echo $res['id'];?>" class="btn btn-danger">Eliminar</a>
                <a target="blank" id="btn-eliminar" href="formModificarInscripto.php?id=<?php echo $res['id'];?>" class="btn btn-warning">Modificar</a>
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
  <script>
    let url = window.location.href;
    let divReporting = document.getElementById('reporting');
    if (url.includes('update=1')) {
      divReporting.innerHTML = `
      <div class="alert alert-warning">Se ha modificado correctamente el inscripto</div>
      `
    };

    if (url.includes('delete=1')) {
      divReporting.innerHTML = `
      <div class="alert alert-danger">Se ha eliminado correctamente el inscripto</div>
      `;
    }

  </script>
</body>
</html>
