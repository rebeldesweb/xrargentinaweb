<?php

  /**
   *
   */
   class Conexion
   {
     static function conectar(){
       $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); //cartacteres especiales

       $link = new PDO(
             //completar con los datos reales de xrargentina
             'mysql:host=69.175.67.50;dbname=laciudad_xrargentina',
             'laciudad_xrargentina',
             'Rebeldesarg1',
            //  'mysql:host=localhost;dbname=xr_argentina',
            //  'root',
            //  '',
             $opciones
             );
       $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); //reporte de errores
       return $link;
     }
   }


?>
