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
  <title>Admin Categorias</title>
  <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
  <link rel="stylesheet" href="../comon/sweetalert2.css">
</head>
<body>
  <nav class="navbar navbar-light bg-light">
    <a href="index.php" class="navbar-brand">Lista de categorias</a>
    <form class="form-inline">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $_SESSION['usuName'];?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="logout.php">Cerrar sesión</a>
          </div>
      </li>
    </form>
  </nav>
  <div class="contenedor-admin my-3" id="tablaCategorias">
    <div class="col-12">
      <table class="table table-bordered table-sm">
        <thead>
          <tr>
            <td class="text-center">ID</td>
            <td class="text-center">CATEGORIA</td>
            <td class="text-center">
              <a onclick="mostrarFormularioAgregar()" class="btn btn-success">Agregar</a>
            </td>
          </tr>
        </thead>
        <tbody id="categorias">
          
        </tbody>
      </table>
    </div>
  </div>

  <!-- formulario de modificar cateogria -->
  <div class="container mt-3 d-none" id="form-modificar">
    <a class="btn btn-warning" onclick="ocultarFormularioModificar()">Regresar al listado de categorias</a>
    <hr>
    <h2 class="mt-2">Formulario de modificación de una categoria</h2>
    <form class="form-group" enctype="multipart/form-data" id="formModificarCategoria">
        
    </form>
  </div>

  <!-- formulario de agregar categoria -->
  <div class="container mt-3 d-none" id="form-agregar">
    <div class="alert alert-success d-none" id="alert-success">Se ha agregado la categoria con éxito</div>
    <a class="btn btn-warning" onclick="ocultarFormularioAgregar()">Regresar al panel de control</a>
    <h2 class="mt-2">Formulario de alta de una nueva categoria</h2>
    <form class="form-group" id="formAgregarCategoria" enctype="multipart/form-data">
        Categoria:
        <input type="text" name="categoria" placeholder="Ingrese fecha el título de la nota" class="form-control mt-3" required>
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
  <script src="js/main.js"></script>
  <script src="js/categoriasNoticia.js"></script>
</body>
</html>
