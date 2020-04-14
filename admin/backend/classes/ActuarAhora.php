<?php

    class ActuarAhora 
    {
        private $id;
        private $titulo;
        private $parrafo;
        private $imagen;
        private $imgPosicion;
        private $link;

        public function listarAccion()
        {
            $link = Conexion::conectar();
            $sql = "SELECT * FROM actuarahora ORDER BY id DESC";
            $stmt = $link->prepare($sql);
            $json = array();
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultado as $reg) {
                $json[] = array(
                    'id' => $reg['id'],
                    'titulo' => $reg['titulo'],
                    'parrafo' => $reg['parrafo'],
                    'imagen' => $reg['imagen'],
                    'imgPosicion' => $reg['imgPosicion'],
                    'link' => $reg['link']
                );
            }
            $jsonString = json_encode($json);
            return $jsonString;
        }

        public function verAccionPorId()
        {
            $id = $_GET['id'];
            $link = Conexion::conectar();
            $sql = "SELECT * FROM actuarahora WHERE id = :id";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->execute();
            $json = array();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $json[] = array(
                'id' => $result['id'],
                'titulo' => $result['titulo'],
                'parrafo' => $result['parrafo'],
                'imagen' => $result['imagen'],
                'imgPosicion' => $result['imgPosicion'],
                'link' => $result['link'] 
            );
            $jsonString = json_encode($json);
            return $jsonString;
        }

        public function modificarAccion()
        {
            $id = $_POST['id'];
            $titulo = $_POST['titulo'];
            $parrafo = $_POST['parrafo'];
            $imagen = $this->subirImagen();
            $imgPosicion = $_POST['imgPosicion'];
            $url = $_POST['link'];
            $link = Conexion::conectar();
            $sql = "UPDATE actuarahora SET  titulo = :titulo,
                                            parrafo = :parrafo,
                                            imagen = :imagen,
                                            imgPosicion = :imgPosicion,
                                            link = :link
                    WHERE id = :id";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(':titulo',$titulo,PDO::PARAM_STR);
            $stmt->bindParam(':parrafo',$parrafo,PDO::PARAM_STR);
            $stmt->bindParam(':imagen',$imagen,PDO::PARAM_STR);
            $stmt->bindParam(':imgPosicion',$imgPosicion,PDO::PARAM_STR);
            $stmt->bindParam(':link',$url,PDO::PARAM_STR);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $result = $stmt->execute();
            if ($result) {
                return json_encode(true);
            }
            return json_encode(false);
        }

        public function agregarAccion()
        {
            $titulo = $_POST['titulo'];
            $parrafo = $_POST['parrafo'];
            $imagen = $this->subirImagen();
            $imgPosicion = $_POST['imgPosicion'];
            $url = $_POST['link'];
            $link = Conexion::conectar();
            $sql = "INSERT INTO actuarahora (titulo,parrafo,imagen,imgPosicion,link)
                        VALUES (:titulo,:parrafo,:imagen,:imgPosicion,:link)";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(':titulo',$titulo,PDO::PARAM_STR);
            $stmt->bindParam(':parrafo',$parrafo,PDO::PARAM_STR);
            $stmt->bindParam(':imagen',$imagen,PDO::PARAM_STR);
            $stmt->bindParam(':imgPosicion',$imgPosicion,PDO::PARAM_STR);
            $stmt->bindParam(':link',$url,PDO::PARAM_STR);
            $result = $stmt->execute();
            if ($result) {
                return json_encode(true);
            }
            return json_encode(false);
        }

        public function eliminarAccion()
        {
            $id = $_GET['id'];
            $link = Conexion::conectar();
            $sql = "DELETE FROM actuarahora WHERE id = :id";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $result = $stmt->execute();
            if ($result) {
                return json_encode(true);
            }
            return json_encode(false);            
        }

        public function subirImagen(){
            $ruta = "../../img/actuarAhora/";
            if (isset($_POST['imagenPrevia'])) {
                //si viene imagen previa quiere decir que viene desde modificar accion
                $imagen = $_POST['imagenPrevia']; //fallback para modificacion de accion
                if (isset($_POST['imagen'])) {
                  $imagen = $_POST['imagen'];
                }
                if ($_FILES['imagen']['error'] == 0) {
                    $imagenTMP = $_FILES['imagen']['tmp_name'];
                    $imagen = $_FILES['imagen']['name'];
                    move_uploaded_file($imagenTMP,$ruta.$imagen);
                }
                return $imagen;
            }
            $imagen = 'noDisponible.jpg'; //fallback para agregar accion
            if (isset($_POST['imagen'])) {
              $imagen = $_POST['imagen'];
            }
            if ($_FILES['imagen']['error'] == 0) {
              $imagenTMP = $_FILES['imagen']['tmp_name'];
              $imagen = $_FILES['imagen']['name'];
              move_uploaded_file($imagenTMP,$ruta.$imagen);
            }
            return $imagen;
        }

    }
    