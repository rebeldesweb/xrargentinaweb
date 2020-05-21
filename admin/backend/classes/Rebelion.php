<?php

  /**
   *
   */
  class Rebelion
  {

    //################# inscriptos #################

    public function agregarInscripto()
    {
      $link = Conexion::conectar();
      $nombre = $_POST['first-name'];
      $apellido = $_POST['last-name'];
      $telefono = $_POST['phone'];
      $cdgPostal = $_POST['postcode'];
      $email = $_POST['email'];
      $sql = "INSERT INTO inscriptos (nombre,apellido,telefono,codigoPostal,email)
                VALUES (:firstname, :lastname, :phone, :postcode, :email)";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':firstname', $nombre, PDO::PARAM_STR);
      $stmt->bindParam(':lastname', $apellido, PDO::PARAM_STR);
      $stmt->bindParam(':phone', $telefono, PDO::PARAM_INT);
      $stmt->bindParam(':postcode', $cdgPostal, PDO::PARAM_INT);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      if ($stmt->execute()) {
        return true;
      }
      return false;
    }


    public function listarInscripto()
    {
      $link = Conexion::conectar();
      $sql = "SELECT id,nombre,apellido,telefono,email,provinciaNombre,ciudadNombre,integracionOK,ADNVOK,organizacion,notas,sendEmail,fecha,grupoLocal
                from inscriptos i, provincia p, ciudades c 
                  where i.provincia = p.idProvincia  and i.ciudad = c.idCiudad AND estado = 1 order by id DESC";
      $stmt = $link->prepare($sql);
      $stmt->execute();
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $json = array();
      foreach ($resultado as $reg) {
        $json[] = array(
          'id' => $reg['id'],
          'nombre' => $reg['nombre'],
          'apellido' => $reg['apellido'],
          'telefono' => $reg['telefono'],
          'email' => $reg['email'],
          'provinciaNombre' => $reg['provinciaNombre'],
          'ciudadNombre' => $reg['ciudadNombre'],
          'integracionOK' => $reg['integracionOK'],
          'ADNVOK' => $reg['ADNVOK'],
          'organizacion' => $reg['organizacion'],
          'notas' => $reg['notas'],
          'fecha' => $reg['fecha'],
          'sendEmail' => $reg['sendEmail'],
          'grupoLocal'=>$reg['grupoLocal']
        );
      }
      $jsonString = json_encode($json);
      return $jsonString;
    }

    public function verInscriptoPorId()
    {
      $id = $_GET['id'];
      $link = Conexion::conectar();
      $sql = "SELECT id,nombre,apellido,telefono,email,provinciaNombre,ciudadNombre,integracionOK,ADNVOK,organizacion,notas,sendEmail,fecha,grupoLocal
              from inscriptos i, provincia p, ciudades c 
              where i.provincia = p.idProvincia  and i.ciudad = c.idCiudad and id = :id AND estado = 1";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_STR);
      $stmt->execute();
      $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
      return $resultado;
    }

    public function eliminarInscripto()
    {
      $id = $_GET['id'];
      $link = Conexion::conectar();
      $sql = "UPDATE inscriptos SET estado = 0 WHERE id = :id";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_STR);
      if($stmt->execute()){
        return true;
      }
      return false;
    }

    public function modificarInscripto()
    {
      $id = $_POST['id'];
      $integracionOK = $_POST['integracionOK'];
      $ADNVOK = $_POST['ADNVOK'];
      $organizacion = $_POST['organizacion'];
      $notas = $_POST['notas'];
      $link = Conexion::conectar();
      $sql = "UPDATE inscriptos SET integracionOK = :integracionOK,
                                    ADNVOK = :ADNVOK,
                                    organizacion = :organizacion,
                                    notas = :notas
              WHERE id = :id";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':integracionOK', $integracionOK, PDO::PARAM_INT);
      $stmt->bindParam(':ADNVOK', $ADNVOK, PDO::PARAM_INT);
      $stmt->bindParam(':organizacion', $organizacion, PDO::PARAM_STR);
      $stmt->bindParam(':notas', $notas, PDO::PARAM_STR);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      if ($stmt->execute()) {
        return true;
      }
      return false;
    }

    public function searchInscripto()
    {
      $search = $_POST['inputSearch'];
      $link = Conexion::conectar();
      $sql = "SELECT id,nombre,apellido,telefono,email,provinciaNombre,ciudadNombre,integracionOK,ADNVOK,organizacion,notas,sendEmail,fecha
              from inscriptos i, provincia p, ciudades c 
              where i.provincia = p.idProvincia  and i.ciudad = c.idCiudad 
              and nombre LIKE '%$search%'
              order by id DESC";
      $stmt = $link->prepare($sql);
      $stmt->execute();
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $json = array();
      foreach ($resultado as $reg) {
        $json[] = array(
          'id' => $reg['id'],
          'nombre' => $reg['nombre'],
          'apellido' => $reg['apellido'],
          'telefono' => $reg['telefono'],
          'email' => $reg['email'],
          'provinciaNombre' => $reg['provinciaNombre'],
          'ciudadNombre' => $reg['ciudadNombre'],
          'integracionOK' => $reg['integracionOK'],
          'ADNVOK' => $reg['ADNVOK'],
          'organizacion' => $reg['organizacion'],
          'notas' => $reg['notas'],
          'fecha' => $reg['fecha'],
          'sendEmail' => $reg['sendEmail']
        );
      }
      $jsonString = json_encode($json);
      return $jsonString;
    }



    //################# EVENTOS #################

    public function subirImagen(){
      $ruta = "../../img/eventos/";
      $imgEvento = 'noDisponible.jpg'; //fallback
      if (isset($_POST['imgEvento'])) {
        $imgEvento = $_POST['imgEvento'];
      }
      if ($_FILES['imgEvento']['error'] == 0) {
        $imgEventoTMP = $_FILES['imgEvento']['tmp_name'];
        $imgEvento = $_FILES['imgEvento']['name'];
        move_uploaded_file($imgEventoTMP,$ruta.$imgEvento);
      }
      return $imgEvento;
    }

    public function agregarEvento()
    {
      $link = Conexion::conectar();
      $diaEventoInicial = $_POST['diaEventoInicial'];
      $horarioInicialEvento = $_POST['horarioInicialEvento'];
      $diaEventoFinal = $_POST['diaEventoFinal'];
      $horarioFinalEvento = $_POST['horarioFinalEvento'];
      $nombreEvento = $_POST['nombreEvento'];
      $lugarEvento = $_POST['lugarEvento'];
      $descripcionEvento = $_POST['descripcion'];
      $imgEvento = $this->subirImagen();
      $numeroEvento = $_POST['numeroEvento'];
      $mesEvento = $_POST['mesEvento'];
      $sql = "INSERT INTO eventos (diaEventoInicial, horarioInicialEvento, diaEventoFinal, horarioFinalEvento,
                                  nombreEvento, lugarEvento, descripcion, imgEvento, numeroEvento, mesEvento)
              VALUES (:diaEventoInicial, :horarioInicialEvento, :diaEventoFinal, :horarioFinalEvento, :nombreEvento, :lugarEvento,
                      :descripcion, :imgEvento, :numeroEvento, :mesEvento)";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':diaEventoInicial', $diaEventoInicial, PDO::PARAM_STR);
      $stmt->bindParam(':horarioInicialEvento', $horarioInicialEvento, PDO::PARAM_STR);
      $stmt->bindParam(':diaEventoFinal', $diaEventoFinal, PDO::PARAM_STR);
      $stmt->bindParam(':horarioFinalEvento', $horarioFinalEvento, PDO::PARAM_STR);
      $stmt->bindParam(':nombreEvento', $nombreEvento, PDO::PARAM_STR);
      $stmt->bindParam(':lugarEvento', $lugarEvento, PDO::PARAM_STR);
      $stmt->bindParam(':descripcion', $descripcionEvento, PDO::PARAM_STR);
      $stmt->bindParam(':imgEvento', $imgEvento, PDO::PARAM_STR);
      $stmt->bindParam(':numeroEvento', $numeroEvento, PDO::PARAM_STR);
      $stmt->bindParam(':mesEvento', $mesEvento, PDO::PARAM_STR);
      if($stmt->execute()){
        return true;
      }
      return false;
    }

    public function modificarEvento()
    {
      $link = Conexion::conectar();
      $id = $_POST['id'];
      $diaEventoInicial = $_POST['diaEventoInicial'];
      $horarioInicialEvento = $_POST['horarioInicialEvento'];
      $diaEventoFinal = $_POST['diaEventoFinal'];
      $horarioFinalEvento = $_POST['horarioFinalEvento'];
      $nombreEvento = $_POST['nombreEvento'];
      $lugarEvento = $_POST['lugarEvento'];
      $descripcionEvento = $_POST['descripcion'];
      $imgEvento = $this->subirImagen();
      $numeroEvento = $_POST['numeroEvento'];
      $mesEvento = $_POST['mesEvento'];
      $sql = "UPDATE eventos SET diaEventoInicial = :diaEventoInicial,
                                  horarioInicialEvento = :horarioInicialEvento,
                                  diaEventoFinal = :diaEventoFinal,
                                  horarioFinalEvento = :horarioFinalEvento,
                                  nombreEvento = :nombreEvento,
                                  lugarEvento = :lugarEvento,
                                  descripcion = :descripcion,
                                  imgEvento = :imgEvento,
                                  numeroEvento = :numeroEvento,
                                  mesEvento = :mesEvento
              WHERE id = :id";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->bindParam(':diaEventoInicial', $diaEventoInicial, PDO::PARAM_STR);
      $stmt->bindParam(':horarioInicialEvento', $horarioInicialEvento, PDO::PARAM_STR);
      $stmt->bindParam(':diaEventoFinal', $diaEventoFinal, PDO::PARAM_STR);
      $stmt->bindParam(':horarioFinalEvento', $horarioFinalEvento, PDO::PARAM_STR);
      $stmt->bindParam(':nombreEvento', $nombreEvento, PDO::PARAM_STR);
      $stmt->bindParam(':lugarEvento', $lugarEvento, PDO::PARAM_STR);
      $stmt->bindParam(':descripcion', $descripcionEvento, PDO::PARAM_STR);
      $stmt->bindParam(':imgEvento', $imgEvento, PDO::PARAM_STR);
      $stmt->bindParam(':numeroEvento', $numeroEvento, PDO::PARAM_STR);
      $stmt->bindParam(':mesEvento', $mesEvento, PDO::PARAM_STR);
      if($stmt->execute()){
        return true;
      }
      return false;
    }

    public function listarEventos()
    {
      $link = Conexion::conectar();
      $sql = "SELECT * FROM eventos";
      $stmt = $link->prepare($sql);
      $stmt->execute();
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $json = array();
      foreach ($resultado as $reg) {
        $json[] = array(
          'id' => $reg['id'],
          'diaEventoInicial' => $reg['diaEventoInicial'],
          'horarioInicialEvento' => $reg['horarioInicialEvento'],
          'diaEventoFinal' => $reg['diaEventoFinal'],
          'horarioFinalEvento' => $reg['horarioFinalEvento'],
          'nombreEvento' => $reg['nombreEvento'],
          'lugarEvento' => $reg['lugarEvento'],
          'descripcion' => $reg['descripcion'],
          'imgEvento' => $reg['imgEvento'],
          'numeroEvento' => $reg['numeroEvento'],
          'mesEvento' => $reg['mesEvento']
        );
      }
      $jsonString = json_encode($json);
      return $jsonString;
    }

    public function verEventoPorId()
    {
      $id = $_GET['id'];
      $link = Conexion::conectar();
      $sql = "SELECT * FROM eventos WHERE id = :id";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $json = array();
      foreach ($resultado as $reg) {
        $json[] = array(
          'id' => $reg['id'],
          'diaEventoInicial' => $reg['diaEventoInicial'],
          'horarioInicialEvento' => $reg['horarioInicialEvento'],
          'diaEventoFinal' => $reg['diaEventoFinal'],
          'horarioFinalEvento' => $reg['horarioFinalEvento'],
          'nombreEvento' => $reg['nombreEvento'],
          'lugarEvento' => $reg['lugarEvento'],
          'descripcion' => $reg['descripcion'],
          'imgEvento' => $reg['imgEvento'],
          'numeroEvento' => $reg['numeroEvento'],
          'mesEvento' => $reg['mesEvento']
        );
      }
      $jsonString = json_encode($json);
      return $jsonString;
    }

    public function eliminarEvento()
    {
      $id = $_GET['id'];
      $link = Conexion::conectar();
      $sql = "DELETE FROM eventos WHERE id = :id";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      if($stmt->execute()){
        return true;
      }
      return false;
    }
    


    //################# NOTICIAS #################

    public function subirImagenNoticia(){
      // $ruta = "../img/noticias/";
      $ruta = "../../img/noticias/";
      $noticiaImagen = 'noDisponible.jpg'; //fallback
      if (isset($_POST['noticiaImagen'])) {
        $noticiaImagen = $_POST['noticiaImagen'];
      }
      if ($_FILES['noticiaImagen']['error'] == 0) {
        $noticiaImagenTMP = $_FILES['noticiaImagen']['tmp_name'];
        $noticiaImagen = $_FILES['noticiaImagen']['name'];
        $bool = move_uploaded_file($noticiaImagenTMP,$ruta.$noticiaImagen);
      }
      return $noticiaImagen;
      // return $_FILES['noticiaImagen']['name'];
      // return $noticiaImagen;
    }

    public function subirImagenes($idNoticia,$imagenes)
    {
      $files = array();
      $responseLogs = array();
      $file_count = count($imagenes['name']); //cantidad de imagenes que cargue
      $file_keys = array_keys($imagenes); //las claves del objeto que viene (name,type,error,size,tmp_name)

      for ($i=0; $i < $file_count; $i++) { 
          foreach ($file_keys as $key) {//esto itera 5 veces porque el objeto tiene 5 claves
              $files[$i][$key] = $imagenes[$key][$i];
          }
      }
      $ruta = "../../img/noticias/";
      foreach ($files as $file) {
        $imagen = $file['name']; //fallback
        if ($file['error'] == 0) {
          $imagenTMP = $file['tmp_name'];
          $bool = move_uploaded_file($imagenTMP,$ruta.$imagen);
          if ($bool) {
            if($this->cargarRegistroImagen($idNoticia,$imagen)){
              array_push($responseLogs,true);
            }else{
              array_push($responseLogs,false);
            };
          }else{
            array_push($responseLogs,false);
          }
        }else{
          array_push($responseLogs,false);
        }
      };
      if(in_array(false,$responseLogs)){
        return false;
      }
      return true;
    }

    public function cargarRegistroImagen($id,$imagen)
    {
      $link = Conexion::conectar();
      $sql = "INSERT INTO imagenesNoticia (idNoticia,imagen) VALUES (:idNoticia,:imagen)";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':idNoticia',$id,PDO::PARAM_INT);
      $stmt->bindParam(':imagen',$imagen,PDO::PARAM_STR);
      if($stmt->execute()){
        return true;
      }
      return false;
    }

    public function agregarNoticia()
    {
      $link = Conexion::conectar();
      $titulo = $_POST['titulo'];
      $idCategoria = $_POST['idCategoria'];
      $fecha = $_POST['fecha'];
      $autor = $_POST['autor'];
      $noticiaImagen = $this->subirImagenNoticia();
      $imagenes = $_FILES['imagenes'];
      $noticia = $_POST['noticia'];
      $sql = "INSERT INTO noticias (titulo, fecha, autor, noticiaImagen, noticia, idCategoria)
              VALUES (:titulo, :fecha, :autor, :noticiaImagen, :noticia, :idCategoria)";
      if(isset($_POST['link']) && $_POST['link']!=''){
        $sql = "INSERT INTO noticias (titulo, fecha, autor, noticiaImagen, noticia, idCategoria,link)
                VALUES (:titulo, :fecha, :autor, :noticiaImagen, :noticia, :idCategoria,:link)";
        $linkUrl = $_POST['link'];
      }
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
      $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
      $stmt->bindParam(':autor', $autor, PDO::PARAM_STR);
      $stmt->bindParam(':noticiaImagen', $noticiaImagen, PDO::PARAM_STR);
      $stmt->bindParam(':noticia', $noticia, PDO::PARAM_STR);
      $stmt->bindParam(':idCategoria', $idCategoria, PDO::PARAM_INT);
      if (isset($linkUrl)) {
        $stmt->bindParam(':link',$linkUrl,PDO::PARAM_STR);
      }
      if($stmt->execute()){
        if(isset($_FILES['imagenes']) && !is_null($_FILES['imagenes'])){
          $loadImages = $this->subirImagenes($link->lastInsertId(),$_FILES['imagenes']);
          if ($loadImages) {
            return true;
          }
        }
        return true;
      }
      return false;
    }

    public function modificarNoticia()
    {
      $link = Conexion::conectar();
      $id = $_POST['id'];
      $titulo = $_POST['titulo'];
      $idCategoria = $_POST['idCategoria'];
      $fecha = $_POST['fecha'];
      $autor = $_POST['autor'];
      $noticiaImagen = $this->subirImagenNoticia();
      $noticia = $_POST['noticia'];
      $linkUrl = $_POST['link'];
      $sql = "UPDATE noticias SET titulo = :titulo,
                                  fecha = :fecha,
                                  autor = :autor,
                                  noticiaImagen = :noticiaImagen,
                                  noticia = :noticia,
                                  idCategoria = :idCategoria,
                                  link = :link
              WHERE id = :id";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
      $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
      $stmt->bindParam(':autor', $autor, PDO::PARAM_STR);
      $stmt->bindParam(':noticiaImagen', $noticiaImagen, PDO::PARAM_STR);
      $stmt->bindParam(':noticia', $noticia, PDO::PARAM_STR);
      $stmt->bindParam(':idCategoria', $idCategoria, PDO::PARAM_INT);
      $stmt->bindParam(':link', $linkUrl, PDO::PARAM_STR);
      if($stmt->execute()){
        return true;
      }
      return false;
    }

    public function listarNoticia()
    {
      $link = Conexion::conectar();
      $sql = "SELECT id,titulo,fecha,autor,noticiaImagen,noticia,categoria 
                FROM noticias AS N, categoriasNoticia AS C
                  WHERE N.idCategoria = C.idCategoria";
      $stmt = $link->prepare($sql);
      $stmt->execute();
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $json = array();
      foreach ($resultado as $reg) {
        $json[] = array(
          'id' => $reg['id'],
          'titulo' => $reg['titulo'],
          'fecha' => $reg['fecha'],
          'autor' => $reg['autor'],
          'noticiaImagen' => $reg['noticiaImagen'],
          'noticia' => $reg['noticia'],
          'categoria' => $reg['categoria']
        );
      }
      $jsonString = json_encode($json);
      return $jsonString;
    }

    public function verNoticiaPorId()
    {
      $id = $_GET['id'];
      $link = Conexion::conectar();
      $sql = "SELECT id,titulo,fecha,autor,noticiaImagen,noticia,N.idCategoria,categoria,link 
                FROM noticias N, categoriasNoticia C
                  WHERE N.idCategoria = C.idCategoria AND id = :id";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $json = array();
      foreach ($resultado as $reg) {
        $json[] = array(
          'id' => $reg['id'],
          'titulo' => $reg['titulo'],
          'fecha' => $reg['fecha'],
          'autor' => $reg['autor'],
          'noticiaImagen' => $reg['noticiaImagen'],
          'noticia' => $reg['noticia'],
          'idCategoria' => $reg['idCategoria'],
          'categoria' => $reg['categoria'],
          'link' => $reg['link']
        );
      }
      $jsonString = json_encode($json);
      return $jsonString;
    }

    public function eliminarNoticia()
    {
      $id = $_GET['id'];
      $link = Conexion::conectar();
      $sql = "DELETE FROM noticias WHERE id = :id";
      $stmt = $link->prepare($sql);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      if($stmt->execute()){
        return true;
      }
      return false;
    }    

  }

?>
