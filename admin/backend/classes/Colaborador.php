<?php

    class Colaborador
    {
        public function listarColaboradorPorTipo()
        {
            $tipo = $_GET['tipo'];
            $link = Conexion::conectar();
            $sql = "SELECT idColaboracion,idInscripto,nombre,apellido,email,colaboracion,telegram 
                        FROM colaboracion c, inscriptos i
                            WHERE c.idInscripto = i.id and colaboracion = :tipo";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(':tipo',$tipo,PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = array();
            foreach ($result as $reg) {
                $json[] = array(
                    'idColaboracion' => $reg['idColaboracion'],
                    'idInscripto' => $reg['idInscripto'],
                    'nombre' => $reg['nombre'],
                    'apellido' => $reg['apellido'],
                    'email' => $reg['email'],
                    'colaboracion' => $reg['colaboracion'],
                    'telegram' => $reg['telegram']
                );
            }
            $jsonString = json_encode($json);
            return $jsonString;
        }

        public function listarColaboradorPorTipoAndId()
        {
            $tipo = $_GET['tipo'];
            $id = $_GET['id'];
            $link = Conexion::conectar();
            $sql = "SELECT idColaboracion,idInscripto,nombre,apellido,email,colaboracion,telegram 
                        FROM colaboracion c, inscriptos i
                            WHERE c.idInscripto = i.id and colaboracion = :tipo and idInscripto = :id";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->bindParam(':tipo',$tipo,PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = array();
            foreach ($result as $reg) {
                $json[] = array(
                    'idColaboracion' => $reg['idColaboracion'],
                    'idInscripto' => $reg['idInscripto'],
                    'nombre' => $reg['nombre'],
                    'apellido' => $reg['apellido'],
                    'email' => $reg['email'],
                    'colaboracion' => $reg['colaboracion'],
                    'telegram' => $reg['telegram']
                );
            }
            $jsonString = json_encode($json);
            return $jsonString;
        }

        public function modificarColaborador()
        {
            $id = $_POST['id'];
            $telegram = $_POST['telegram'];
            $link = Conexion::conectar();
            $sql = "UPDATE colaboracion SET telegram = :telegram WHERE idInscripto = :id";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(':telegram',$telegram,PDO::PARAM_STR);
            $stmt->bindParam(':id',$id,PDO::PARAM_STR);
            $result = $stmt->execute();
            if ($result) {
                return json_encode(true);
            }
            return json_encode(false);
        }
    }
