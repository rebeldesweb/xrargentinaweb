<?php

    class Colaborador
    {
        public function listarColaboradorPorTipo()
        {
            $tipo = $_GET['tipo'];
            $link = Conexion::conectar();
            $sql = "SELECT idColaboracion,nombre,apellido,email,colaboracion 
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
                    'nombre' => $reg['nombre'],
                    'apellido' => $reg['apellido'],
                    'email' => $reg['email'],
                    'colaboracion' => $reg['colaboracion']
                );
            }
            $jsonString = json_encode($json);
            return $jsonString;
        }
    }
