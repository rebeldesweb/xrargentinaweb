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
  <title>Admin Noticias</title>
  <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://bootswatch.com/4/united/bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="../css/style.css"> -->
  <link rel="stylesheet" href="../comon/sweetalert2.css">
</head>
<body>
  <nav class="navbar navbar-light bg-light">
    <a href="index.php" class="navbar-brand">Lista de noticias</a>
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
  <div class="contenedor-admin my-3" id="tablaNoticias">
    <div class="col-12">
      <table class="table table-bordered table-sm">
        <thead>
          <tr>
            <td class="text-center">TITULO</td>
            <td class="text-center">CATEGORIA</td>
            <td class="text-center">FECHA</td>
            <td class="text-center">AUTOR</td>
            <td class="text-center">
              <a onclick="mostrarFormularioAgregar()" class="btn btn-success">Agregar</a>
              <a href="adminCategorias.php" class="btn btn-success">Administrar Categorias</a>
            </td>
          </tr>
        </thead>
        <tbody id="noticias">
          
        </tbody>
      </table>
    </div>
  </div>

  <!-- formulario de modificar evento -->
  <div class="container mt-3 d-none" id="form-modificar">
    <a class="btn btn-warning" onclick="ocultarFormularioModificar()">Regresar al listado de eventos</a>
    <hr>
    <h2 class="mt-2">Formulario de modificación de un nuevo evento</h2>
    <form class="form-group" enctype="multipart/form-data" id="formModificarNoticia">
        
    </form>
  </div>

  <!-- formulario de agregar evento -->
  <div class="container mt-3 d-none" id="form-agregar">
    <div class="alert alert-success d-none" id="alert-success">Se ha agregado la noticia con éxito</div>
    <a class="btn btn-warning" onclick="ocultarFormularioAgregar()">Regresar al panel de control</a>
    <h2 class="mt-2">Formulario de alta de una nueva noticia</h2>
    <form class="form-group" id="formAgregarNoticia" enctype="multipart/form-data">
        <br>
        Título:
        <input type="text" name="titulo" placeholder="Ingrese fecha el título de la nota" class="form-control mt-3" required>
        <br>
        Categoria:
        <br>
        <select name="idCategoria" id="categoriaAgregar" class="form-control">
        </select>
        <br>
        Fecha:
        <input type="text" name="fecha" placeholder="Ingrese fecha de la nota" class="form-control mt-3" required>
        <hr>
        <input type="text" name="autor" placeholder="Nombre del autor" class="form-control mt-3" required>
        <textarea name="noticia" class="form-control mt-3" placeholder="Ingrese el cuerpo de la noticia" cols="30" rows="30" required></textarea>
        <label class="mt-3">Cargue la foto de la nota:</label>
        <input type="file" name="noticiaImagen" class="mt-1"/>
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
  <script src="js/noticia.js"></script>
</body>
</html>
