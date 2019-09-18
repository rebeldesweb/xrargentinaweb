<?php
    require 'config/config.php';
    $objRebelion = new Rebelion();
    $registro = $objRebelion->verInscriptoPorId();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="comon/sweetalert2.css">
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
</head>
<body>
    <div class="container text-center mt-4">
        <form action="delete.php" method="POST">
            <h3>Usuario a eliminar: <?php echo $registro['nombre'] ?></h3>
            <br><br>
            <input type="submit" class="btn btn-danger" value="Eliminar">
            <input type="hidden" name="id" value="<?php echo $registro['id'] ?>">
        </form>
    </div>
    <script src="comon/sweetalert2.js" charset="utf-8"></script>
    <script>
        Swal.fire({
            title: '¿Seguro quiere eliminar el usuario?',
            text: "Esta acción no se puede deshacer!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, quiero eliminar!'
            }).then((result) => {
            if (result.value) {
            }
        })
    </script>
</body>
</html>