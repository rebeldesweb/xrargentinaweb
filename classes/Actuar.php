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

    }