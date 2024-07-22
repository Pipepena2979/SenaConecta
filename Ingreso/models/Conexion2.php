<?php

    class conexionmensaje{       
        public function get_conexion(){
            include('Configuracion.php');
            $conexion= new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
            return $conexion;
        }
    }

?>