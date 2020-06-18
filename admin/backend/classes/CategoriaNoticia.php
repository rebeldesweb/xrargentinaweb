<?php
    class CategoriaNoticia
    {
        public function listarCategorias()
        {
            $link = Conexion::conectar();
            $sql = "SELECT * FROM categoriasNoticia ORDER BY categoria ASC";
            $stmt = $link->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = array();
            foreach ($resultado as $reg) {
                $json[] = array(
                    'idCategoria' => $reg['idCategoria'],
                    'categoria' => $reg['categoria']
                );
            }
            $jsonString = json_encode($json);
            return $jsonString;
        }

        public function verCategoriaPorId()
        {
            $id = $_GET['idCategoria'];
            $link = Conexion::conectar();
            $sql = "SELECT * FROM categoriasNoticia WHERE idCategoria = :id";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = array();
            foreach ($resultado as $reg) {
                $json[] = array(
                    'idCategoria' => $reg['idCategoria'],
                    'categoria' => $reg['categoria']
                );
            }
            $jsonString = json_encode($json);
            return $jsonString;
        }

        public function agregarCategoria()
        {
            $link = Conexion::conectar();
            $categoria = $_POST['categoria'];
            $sql = "INSERT INTO categoriasNoticia (categoria) VALUES (:categoria)";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(':categoria',$categoria,PDO::PARAM_STR);
            if ($stmt->execute()) {
                return json_encode(array('status'=>200,'info'=>'Categoria agregada'));
            }
            return json_encode(array('status'=>400,'info'=>'Problemas al insertar la categoria'));
        }

        public function borrarCategoria()
        {
            $id=$_GET['idCategoria'];
            $link = Conexion::conectar();
            $sql = "DELETE FROM categoriasNoticia WHERE idCategoria = :id";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            if ($stmt->execute()) {
                return json_encode(array('status'=>200,'info'=>'Categoria Eliminada'));
            }
            return json_encode(array('status'=>400,'info'=>'No se pudo eliminar la categoria'));
        }

        public function modificarCategoria()
        {
            $idCategoria = $_POST['idCategoria'];
            $categoria = $_POST['categoria'];
            $link = Conexion::conectar();
            $sql = "UPDATE categoriasNoticia SET categoria = :categoria
                    WHERE idCategoria = :id";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(':categoria',$categoria,PDO::PARAM_STR);
            $stmt->bindParam(':id',$idCategoria,PDO::PARAM_INT);
            if ($stmt->execute()) {
                return json_encode(array('status'=>200,'info'=>'Categoria Modificada'));
            }
            return json_encode(array('status'=>200,'info'=>'Problemas al modificar la categoria'));
        }
    }
    