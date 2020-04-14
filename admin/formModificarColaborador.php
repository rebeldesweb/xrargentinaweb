<?php
  require 'config/config.php';
  $objColaborador = new Colaborador();
  $reg = $objColaborador->listarColaboradorPorTipoAndId();
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
  <style>
      .header{padding: 30px;background-color: #399a46; color: #f4f4f4}
  </style>
</head>
<body>
  <nav class="navbar navbar-light bg-light">
    <a href="index.php" class="navbar-brand">Admin Suscriptores</a>
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
    <a class="btn btn-warning" href="adminColaboradores.php">Regresar al listado de inscriptos</a>
    <hr>
    <br>
    <h2 class="mt-2">Formulario de modificación de inscripto</h2>
    <form action="" class="form-group" id="form-modificar-colaborador">
        <!-- id oculto -->
        <input type="hidden" name="id" value="<?php echo $reg['idInscripto'] ?>">
        <br>
        <header class="header">
            <h3 class="text-center "><?php echo $reg['nombre'],' ', $reg['apellido'] ?></h3>
        </header>

        <div class="container mt-3">
            <div class="container-fluid">
                <center><span class="text-muted">DATOS GENERALES</span></center>
                <hr>
                <div class="row">
                    <div class="col-3">
                        <p class="text-center lbl">Nombre:</p>
                        <p class="text-center text-muted"><?php echo $reg['nombre'] ?></p>
                    </div>
                    <div class="col-3">
                        <p class="text-center lbl">Apellido:</p>
                        <p class="text-center text-muted"><?php echo $reg['apellido'] ?></p>
                    </div>
                    <div class="col-3">
                        <p class="text-center lbl">Colaboracion</p>
                        <p class="text-center text-muted"><?php echo $reg['colaboracion'] ?></p>
                    </div>
                    <div class="col-3">
                        <p class="text-center lbl">Email</p>
                        <p class="text-center text-muted"><?php echo $reg['email'] ?></p>
                    </div>
                    <div class="col-12">
                        <p class="text-center lbl">Telegram:</p>
                        <input type="text" name="telegram" class="form-control" value="<?php echo $reg['telegram'] ?>">
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <center><input type="submit" class="btn btn-warning" value="Modificar"></center>
    </form>
  </div>
  

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="../comon/sweetalert2.js" charset="utf-8"></script>
  <script>
        // MODIFICAR COLABORADOR

        let formModificarColaborador = document.getElementById('form-modificar-colaborador');
        formModificarColaborador.addEventListener('submit',e=>{
            e.preventDefault();
            let data = new FormData(formModificarColaborador);
            fetch('backend/modificarColaborador.php',{
                method:'POST',
                body: data
            })
            .then(res=>res.json())
            .then(newRes=>{
                if (newRes) {
                    alert('Colaborador Modificado')
                }else{
                    alert('Problemas al modificar')
                }
            })
        })
  </script>
</body>
</html>