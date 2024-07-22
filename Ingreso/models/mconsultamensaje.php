<?php

include('Conexion2.php');

    class Consultasmensaje{


        public function traermensaje($docreceptor){

            $modelo = new conexionmensaje();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT men.*, tipomen.importancia, infoemi.nombres as nombreemi, infoemi.apellidos as apellidoemi, infore.nombres as nombrere,  infore.apellidos as apellidore,infoemi.foto AS fotoemisor, rolemi.nombre as rolemi FROM mensaje as men
            INNER JOIN tipomensaje as tipomen on men.tipo =tipomen.id
            INNER JOIN person as infoemi on men.num_doc_emisor = infoemi.num_doc
            INNER JOIN person as infore on men.num_doc_receptor = infore.num_doc
            INNER JOIN roles as rolemi on infoemi.rol = rolemi.id
            WHERE num_doc_receptor= $docreceptor ORDER BY men.fechaenvio DESC;";
            $result = $conexion->prepare($sql);
            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;

        }

        public function tipomensaje(){

            $modelo = new conexionmensaje();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM tipomensaje";
            $result = $conexion->prepare($sql);
            $result->execute();
            // $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;

        }

        public function mensajeleido($id,$newestado,$fechaleido){

            $modelo = new conexionmensaje();
            $conexion = $modelo->get_conexion();
            $sql = "UPDATE `mensaje` SET `estado`='$newestado',`fechaleido`='$fechaleido' WHERE id=$id";
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result;

        }

        public function borrarleidos(){

            $modelo = new conexionmensaje();
            $conexion = $modelo->get_conexion();
            $sql = "DELETE FROM `mensaje` WHERE estado = 'leido'";
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result;

        }
        public function consultarTipoMensaje($tipoMensaje){
            $modelo = new conexionmensaje();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM tipomensaje WHERE id=$tipoMensaje";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarReceptor($receptor){
            $modelo = new conexionmensaje();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM person WHERE num_doc=$receptor AND rol=3";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function guardarMensaje($tituloMensaje,$tipoMensaje,$mensaje,$emisor,$receptor,$fechaEnvio){
            $modelo = new conexionmensaje();
            $conexion = $modelo->get_conexion();
            $sql = "INSERT INTO `mensaje` (`Titulo`, `mensaje`, `num_doc_emisor`, `num_doc_receptor`, `tipo`, `fechaenvio`)
             VALUES 
             ('$tituloMensaje','$mensaje',$emisor,$receptor,$tipoMensaje,'$fechaEnvio')";

            //  var_dump($sql);
            //  die();


            $result = $conexion->prepare($sql);
            $result->execute();
            // $resultado = false;
            
            return $result;
        }
    }
?>