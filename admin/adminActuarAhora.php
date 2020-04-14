<?php
  require 'config/config.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin Actuar Ahora</title>
  <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://bootswatch.com/4/united/bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="../css/style.css"> -->
  <link rel="stylesheet" href="../comon/sweetalert2.css">
</head>
<body>
  <nav class="navbar navbar-light bg-light">
    <a href="index.php" class="navbar-brand">Actuar Ahora</a>
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

  <div class="contenedor-admin my-3" id="tablaAcciones">
    <div class="col-12">
      <a id="btnBack" class="btn btn-warning mb-3" href="index.php">Volver al menú</a>
      <div id="reporting"></div>
      <table class="table table-bordered table-sm" id="table">
        <thead>
          <tr>
            <!-- <td class="text-center">ID</td> -->
            <td class="text-center">TÍTULO</td>
            <td class="text-center">CONTENIDO</td>
            <td class="text-center">IMÁGEN</td>
            <td class="text-center">POSICIÓN IMÁGEN</td>
            <td class="text-center">LINK</td>
            <td class="text-center">
              <a onclick="mostrarFormularioAgregar()" class="btn btn-success">Agregar</a>
            </td>
          </tr>
        </thead>
        <tbody id="filaAcciones">
          
        </tbody>
      </table>
    </div>
  </div>

  <!-- formulario de modificar accion -->
  <div class="container mt-3 d-none" id="form-modificar">
    <a class="btn btn-warning" onclick="ocultarFormularioModificar()">Regresar al listado de acciones</a>
    <hr>
    <h2 class="mt-2">Formulario de modificación</h2>
    <form class="form-group" enctype="multipart/form-data" id="formModificarAccion">
        
    </form>
  </div>

  <!-- formulario de agregar accion -->
  <div class="container mt-3 d-none" id="form-agregar">
    <div class="alert alert-success d-none" id="alert-success">Se ha agregado la accion con éxito</div>
    <a class="btn btn-warning" onclick="ocultarFormularioAgregar()">Regresar</a>
    <h2 class="mt-2">Formulario de alta de una nueva acción</h2>
    <form class="form-group"  id="formAgregarAccion" enctype="multipart/form-data">
        <br>
        <input type="text" name="titulo" placeholder="Titulo" class="form-control mt-3" required>
        <br>
        <label for="">Descipción</label>
        <textarea name="parrafo" class="form-control" cols="15" rows="5"></textarea>
        <hr>
        <input type="file" name="imagen" class="mt-1"/>
        <br><br><br>
        <select name="imgPosicion" class="form-control">
          <option value="Derecha">Posición de la imagen</option>
          <option value="derecha">Derecha</option>
          <option value="izquierda">Izquierda</option>
        </select>
        <input type="text" name="link" class="form-control mt-3" placeholder="URL de la accion" required>
        <br>
        <center>
            <input type="submit" class="btn btn-info mt-3" value="Agregar Acción">
        </center>
    </form>
  </div>





  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="../comon/sweetalert2.js" charset="utf-8"></script>
  <script src="js/main.js"></script>
  <script src="js/actuar.js"></script>
</body>
</html>