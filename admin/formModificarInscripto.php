<?php
  require 'config/config.php';
  $objRebelion = new Rebelion();
  $reg = $objRebelion->verInscriptoPorId();

  //harcodeo para los select de integracion y adnv. Si viene un cero desde la base de datos muestro determinados valores en los options. En cambio si viene un 1 muestro otros valores en los options -> VER LINEAS 94-110
  $integracionOKText = 'NO';
  $integracionOK = $reg['integracionOK'];
  if ($integracionOK == 1) {
    $integracionOKText = 'SI';
  }

  $ADNVOKText = 'NO';
  $ADNVOK = $reg['ADNVOK'];
  if ($ADNVOK == 1) {
    $ADNVOKText = 'SI';
  }

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
    <a class="navbar-brand">Admin Suscriptores</a>
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
    <a class="btn btn-warning" href="admin.php">Regresar al listado de inscriptos</a>
    <hr>
    <br>
    <h2 class="mt-2">Formulario de modificación de inscripto</h2>
    <form action="modificarInscripto.php" class="form-group" method="post">
        <!-- id oculto -->
        <input type="hidden" name="id" value="<?php echo $reg['id'] ?>">
        <br>
        <header class="header">
            <h3 class="text-center "><?php echo $reg['nombre'],' ', $reg['apellido'] ?></h3>
        </header>

        <div class="container mt-3">
            <div class="container-fluid">
                <center><span class="text-muted">DATOS GENERALES</span></center>
                <hr>
                <div class="row">
                    <div class="col-2">
                        <p class="text-center lbl">Nombre:</p>
                        <p class="text-center text-muted"><?php echo $reg['nombre'] ?></p>
                    </div>
                    <div class="col-2">
                        <p class="text-center lbl">Apellido:</p>
                        <p class="text-center text-muted"><?php echo $reg['apellido'] ?></p>
                    </div>
                    <div class="col-2">
                        <p class="text-center lbl">Telefono:</p>
                        <p class="text-center text-muted"><?php echo $reg['telefono'] ?></p>
                    </div>
                    <div class="col-2">
                        <p class="text-center lbl">Código postal:</p>
                        <p class="text-center text-muted"><?php echo $reg['codigoPostal'] ?></p>
                    </div>
                    <div class="col-4">
                        <p class="text-center lbl">Email</p>
                        <p class="text-center text-muted"><?php echo $reg['email'] ?></p>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-3">
                        <p class="text-center lbl">Integracion OK:</p>
                        <select name="integracionOK" class="form-control" id="">
                            <option value="<?php echo $reg['integracionOK'] ?>"><?php echo $integracionOKText ?></option>
                            <?php if ($integracionOKText == 'NO') {?>
                                <option value="1">SI</option>
                            <?php }else{?>
                                <option value="0">NO</option>
                            <?php };?>
                        </select>
                    </div>
                    <div class="col-3">
                    <p class="text-center lbl">ADNV Ok:</p>
                        <select name="ADNVOK" class="form-control" id="">
                            <option value="<?php echo $reg['ADNVOK'] ?>"><?php echo $ADNVOKText ?></option>
                            <?php if ($ADNVOKText == 'NO') {?>
                                <option value="1">SI</option>
                            <?php }else{?>
                                <option value="0">NO</option>
                            <?php };?>
                        </select>
                    </div>
                    <div class="col-3">
                    <p class="text-center lbl">Organización:</p>
                        <input type="text" name="organizacion" class="form-control" value="<?php echo $reg['organizacion'] ?>">
                    </div>
                    <div class="col-3">
                    <p class="text-center lbl">Nota:</p>
                        <input type="text" name="notas" class="form-control" value="<?php echo $reg['notas'] ?>">
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