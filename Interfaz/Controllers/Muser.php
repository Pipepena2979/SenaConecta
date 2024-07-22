<?php

include("../Models/Conexion.php");
    class Usuario{
        public function login($ndocumento){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM person WHERE num_doc=$ndocumento";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function fechaControl($nDoc,$fechaS){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "INSERT INTO iniciosession (`nDocFecha`, `fechaR`)
            VALUES 
            ($nDoc, '$fechaS')";
            // var_dump($sql);
            // die();
            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function fechaSession($fechaS,$nDoc){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "UPDATE person SET `fechaSession`='$fechaS' WHERE `num_doc`=$nDoc";
            // var_dump($sql);
            // die();
            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function municipios($id){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM municipios WHERE iddepar=$id ORDER BY Nom_municipio ASC";
            // var_dump($sql);
            // die();
            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function contacto($nombre,$email,$subject,$message,$fechaRegistro){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "INSERT INTO contacto (`nombres`, `email`, `asunto`, `mensaje`, `fechaRegistro`)
            VALUES 
            ('$nombre', '$email', '$subject', '$message', '$fechaRegistro')";
            // var_dump($sql);
            // die();
            $result = $conexion->prepare($sql);
            $result->execute();
            // $resultado = false;
            
            return $result;
        }


    }


?>