<?php
    include("Conexion.php");
    class Consultas{
        public function salir(){
            if (session_status() !== PHP_SESSION_ACTIVE) {
                // Si no está iniciada, la iniciamos
                session_start();
            }
            session_destroy();
            echo "<script>location.href='../../index.php'</script>";
        }
        public function consultarUsuario($id){

            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM `person` WHERE id=$id;";
            
            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;

        }
        public function eliminarUsuario($id,$editor){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "UPDATE person SET `estado`=2, editadoUltimaVez=$editor  WHERE id=$id";
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result;
        }
        public function eliminarPerfiles($nDoc){

            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "DELETE FROM perfil_instructor WHERE nDocPerfil=$nDoc";
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result;

        }
        
        public function eliminarComentario($id){

            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "UPDATE `contacto` SET `estado`=2 WHERE id=$id";
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result;

        }
        public function eliminarCompetencias($codigoCompetencia){

            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "DELETE FROM competencia WHERE cod_competencia=$codigoCompetencia";
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result;

        }

        public function eliminarAmbiente($id){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "DELETE FROM ambientes WHERE id=$id";
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result;
        }

        public function eliminarCurso($codigoCurso){

            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "DELETE FROM estructura_curricular WHERE codigo_prog=$codigoCurso";
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result;

        }
        public function actualizarInformacion($eN2,$eA2,$eCorreo,$eTel,$eGenero,$eDepartamento,$eCiudad,$nDoc){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql="UPDATE person SET `nombres`='$eN2',`apellidos`='$eA2', `Correo`='$eCorreo', `Telefono`=$eTel , `genero`= $eGenero , departamento = $eDepartamento, municipio= $eCiudad WHERE `num_doc`=$nDoc";
            // var_dump($sql);
            // die();
            $result = $conexion->prepare($sql);
            $result->execute();

        }
        public function editarCurso($eNombreCurso,$eNivelCurso,$eVersionCurso,$eDescripcionCurso,$codigo){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql="UPDATE estructura_curricular SET `denominacion_prog`='$eNombreCurso',`nivel`=$eNivelCurso, `version`=$eVersionCurso, `descripcion`='$eDescripcionCurso' WHERE `codigo_prog`=$codigo";
            // var_dump($sql);
            // die();
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result;

        }
        public function editarCompetencia($eNombreCompetencia,$eTipoCompetencia,$eHoras,$eResultadosAprendizaje,$codigoCompetencia){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql="UPDATE competencia SET `nom_competencia`='$eNombreCompetencia',`tipoCompetencia`=$eTipoCompetencia, `horas`=$eHoras, `resultadosAprendizaje`=$eResultadosAprendizaje WHERE `cod_competencia`=$codigoCompetencia";
            // var_dump($sql);
            // die();
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result;   

        }
        public function asignacionesInstructor($nDoc){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT a.*, p.nombres,p.apellidos,n.nom_nivel,ec.denominacion_prog,tc.tipo,c.nom_competencia, j.Nombre AS nombreJornada, reg.Nom_regiones, mun.Nom_municipio
            FROM asignacion_instructor AS a
            INNER JOIN person AS p ON p.num_doc=a.nDocInstructor
            INNER JOIN nivel AS n ON n.id=a.nivel
            INNER JOIN estructura_curricular AS ec ON ec.codigo_prog=a.nom_titulacion
            INNER JOIN tipo_competencia AS tc ON tc.id=a.tipocompetencia
            INNER JOIN competencia AS c ON c.cod_competencia=a.competencia
            INNER JOIN jornada AS j ON ec.jornada=j.id
            INNER JOIN regiones AS reg ON ec.region=reg.id
            INNER JOIN municipios AS mun ON ec.municipio=mun.id
            WHERE a.nDocInstructor=$nDoc ORDER BY a.fecha_inicio DESC";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
            

        public function asignacionesTotales(){ 
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT a.*, CONCAT(p.nombres, ' ', p.apellidos) AS nombreInstructor, n.nom_nivel, ec.denominacion_prog, tc.tipo, c.nom_competencia, j.Nombre AS nombreJornada, reg.Nom_regiones, mun.Nom_municipio, tr.nombreRubro, am.ambiente AS nombreAmbiente
                    FROM asignacion_instructor AS a
                    INNER JOIN person AS p ON p.num_doc = a.nDocInstructor
                    INNER JOIN nivel AS n ON n.id = a.nivel
                    INNER JOIN estructura_curricular AS ec ON ec.codigo_prog = a.nom_titulacion
                    INNER JOIN tipo_competencia AS tc ON tc.id = a.tipocompetencia
                    INNER JOIN competencia AS c ON c.cod_competencia = a.competencia
                    INNER JOIN jornada AS j ON ec.jornada = j.id
                    INNER JOIN regiones AS reg ON ec.region = reg.id
                    INNER JOIN municipios AS mun ON ec.municipio = mun.id
                    INNER JOIN tiporubro AS tr ON tr.id = a.rubro
                    INNER JOIN ambientes AS am ON am.id = a.id_ambiente
                    ORDER BY a.fecha_inicio DESC";
        
            $result = $conexion->prepare($sql);
            $result->execute();
        
            $resultado = [];
            while ($f = $result->fetch(PDO::FETCH_ASSOC)) {
                $resultado[] = $f;
            }
            return $resultado;
        }  

        public function actualizarContrasena($pass,$nDoc){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql="UPDATE person SET `contrasena`='$pass' WHERE `num_doc`=$nDoc";
            // var_dump($sql);
            // die();
            $result = $conexion->prepare($sql);
            $result->execute();

        }

        public function actualizarSupervisor($enDoc){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql="UPDATE person SET `supervisor`= NULL WHERE `num_doc`=$enDoc";
            // var_dump($sql);
            // die();
            $result = $conexion->prepare($sql);
            $result->execute();

        }

        public function actualizarFoto($numDoc,$rutafinalSql){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql="UPDATE person SET foto='$rutafinalSql' WHERE num_doc=$numDoc;";
            // var_dump($sql);
            // die();
            $result = $conexion->prepare($sql);
            $result->execute();

          }

          public function consultarSupervisorE($eSupervisor,$rol){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM person WHERE num_doc=$eSupervisor AND rol=$rol";

           

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarUsuarioCalendario($nDoc){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT p.*, r.Nombre AS nombreRol
            FROM person AS p
            INNER JOIN roles AS r ON p.rol=r.id
            WHERE p.num_doc=$nDoc";

            // $sql = "SELECT ec.*, n.nom_nivel
            // FROM estructura_curricular AS ec
            // INNER JOIN nivel AS n ON ec.nivel=n.id
            // WHERE ec.codigo_prog=$codigo";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarAmbiente($eAmbiente,$nAmbiente){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM  ambientes WHERE id=$eAmbiente AND ambiente='$nAmbiente'";
            $result = $conexion->prepare($sql);
            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

        public function validarAmbiente($ambiente){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM  ambientes WHERE ambiente='$ambiente'";
            $result = $conexion->prepare($sql);
            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

         public function validarAmbiente2($id){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM  ambientes WHERE id= $id";
            $result = $conexion->prepare($sql);
            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

        public function insertAmbiente($ambiente){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "INSERT INTO `ambientes`(`ambiente`) VALUES ('$ambiente')";
            $result = $conexion->prepare($sql);
            $result->execute();
            // $resultado = false;
            
            return $result;
        }

        public function updateAmbiente($eAmbiente,$id){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "UPDATE `ambientes` SET `ambiente`= '$eAmbiente' WHERE id=$id";
            $result = $conexion->prepare($sql);
            $result->execute();
            // $resultado = false;
            
            return $result;
        }

        public function consultarCursoCalendario($codigoCurso){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT ec.*,n.nom_nivel
            FROM estructura_curricular AS ec 
            INNER JOIN nivel AS n ON ec.nivel=n.id
            WHERE codigo_prog=$codigoCurso";

            // $sql = "SELECT ec.*, n.nom_nivel
            // FROM estructura_curricular AS ec
            // INNER JOIN nivel AS n ON ec.nivel=n.id
            // WHERE ec.codigo_prog=$codigo";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarnTdoc($etDoc){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM tdocumento WHERE id=$etDoc";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarComentario($id){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM contacto WHERE id=$id";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarCodigocompe($codigocompe){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM competencia WHERE cod_competencia=$codigocompe";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarCurso($codigo){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT ec.*, n.nom_nivel
            FROM estructura_curricular AS ec
            INNER JOIN nivel AS n ON ec.nivel=n.id
            WHERE ec.codigo_prog=$codigo";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultartCompetencia($tCompetencia){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM tipo_competencia WHERE id=$tCompetencia";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarNivelC($eNivelCurso){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM nivel WHERE id=$eNivelCurso";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarCompe($compeasignada){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT c.*, tc.tipo
            FROM competencia AS c 
            INNER JOIN tipo_competencia AS tc ON c.tipoCompetencia=tc.id
            WHERE c.cod_competencia=$compeasignada";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarPerfilRequerido($tipoperfilasignada){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM perfiles WHERE id=$tipoperfilasignada";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarCorreo($correo){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM person WHERE Correo='$correo'";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarTelefono($nTelefono){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM person WHERE Telefono=$nTelefono";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarnRol($eRol){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM roles WHERE id=$eRol";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarnDoc($nDoc){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT p.*, m.iddepar
            FROM person AS p 
            INNER JOIN municipios AS m ON p.municipio=m.id
            WHERE p.num_doc=$nDoc AND p.estado=1";

              // $sql = "SELECT ec.*, n.nom_nivel
            // FROM estructura_curricular AS ec
            // INNER JOIN nivel AS n ON ec.nivel=n.id
            // WHERE ec.codigo_prog=$codigo";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

        public function verificarPerfiles($nDoc){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM perfil_instructor WHERE nDocPerfil=$nDoc";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarNivel(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM nivel ";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

        public function consultarRubro($rubro){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM tiporubro WHERE id=$rubro";

            $result = $conexion->prepare($sql);
            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

        public function consultarTitulacion($titulacion){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM estructura_curricular WHERE codigo_prog=$titulacion";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultartipocompetencia($tipocompetencia){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM tipo_competencia WHERE id=$tipocompetencia";

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
        public function consultarCompetencia($competencia){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM competencia WHERE cod_competencia=$competencia";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarJornada($jornada){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM jornada WHERE id=$jornada";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarDepartamento($departamento){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM departamentos WHERE iddpar=$departamento";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarMunicipioD($eDepartamento,$eMunicipio){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM municipios WHERE iddepar=$eDepartamento AND id=$eMunicipio";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarZona($zona){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM regiones WHERE id=$zona";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarMunicipio($municipio){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM municipios WHERE id=$municipio";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarMunicipioRegistrar($departamento){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM municipios WHERE iddepar=$departamento";
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
        public function consultarOcupado2($nDoc,$id,$fecha_inicio,$fecha_fin){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM asignacion_instructor 
            WHERE (nDocInstructor=$nDoc AND id!=$id) 
            AND 
            (fecha_inicio <= '$fecha_fin' AND  fecha_fin >= '$fecha_inicio')";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarOcupadoCurso2($titulacion,$id,$fecha_inicio,$fecha_fin){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM asignacion_instructor 
            WHERE (nom_titulacion=$titulacion  AND id!=$id) 
            AND 
            (fecha_inicio <='$fecha_fin' AND  fecha_fin >= '$fecha_inicio')";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarOcupado($nDoc,$fecha_inicio,$fecha_fin){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM asignacion_instructor 
            WHERE (nDocInstructor=$nDoc) 
            AND 
            (fecha_inicio <= '$fecha_fin' AND  fecha_fin >= '$fecha_inicio')";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarCompetenciaAjax($id){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM competencia 
            WHERE tipoCompetencia=$id";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarOcupadoCurso($titulacion,$fecha_inicio,$fecha_fin){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM asignacion_instructor 
            WHERE (nom_titulacion=$titulacion) 
            AND 
            (fecha_inicio <='$fecha_fin' AND  fecha_fin >= '$fecha_inicio')";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarSupervisor($supervisor){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM person WHERE num_doc=$supervisor";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarSupervisorAjax($rol){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM person WHERE rol=$rol";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function consultarGenero($genero){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM genero WHERE id=$genero";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function contarCoordinadorMisional(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT COUNT(id) AS contar FROM person WHERE rol=1";

            
            $result = $conexion->prepare($sql);
            
            $result->execute();
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function contarCoordinador(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT COUNT(id) AS contar FROM person WHERE rol=2";

            
            $result = $conexion->prepare($sql);
            
            $result->execute();
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function contarInstructores(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT COUNT(id) AS contar FROM person WHERE rol=3";

            
            $result = $conexion->prepare($sql);
            
            $result->execute();
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function contarFemenino(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT COUNT(id) AS contar FROM person WHERE genero=1";

            
            $result = $conexion->prepare($sql);
            
            $result->execute();
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function contarMasculino(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT COUNT(id) AS contar FROM person WHERE genero=2";

            
            $result = $conexion->prepare($sql);
            
            $result->execute();
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function contarOtros(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT COUNT(id) AS contar FROM person WHERE genero=3";

            
            $result = $conexion->prepare($sql);
            
            $result->execute();
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function guardarProgramacion($nDoc,$nivel,$titulacion,$tipocompetencia,$competencia,$ambiente,$color_evento,$fecha_inicio,$fecha_fin,$fechaProgramacion,$asignada,$rubro){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "INSERT INTO `asignacion_instructor` (`nDocInstructor`, `nivel`, `nom_titulacion`, `tipocompetencia`, `competencia`, `color_evento`,`fecha_inicio`, `fecha_fin`, `fechaAsignacion`, `nDocRegistradoPor` , `rubro` , `id_ambiente` )
             VALUES 
             ($nDoc,$nivel,$titulacion,$tipocompetencia,$competencia,'$color_evento','$fecha_inicio', '$fecha_fin','$fechaProgramacion', $asignada, $rubro , $ambiente)";

            //  var_dump($sql);
            //  die();


            $result = $conexion->prepare($sql);
            $result->execute();
            // $resultado = false;
            
            return $result;
        }
        public function mostrarnombres(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM person WHERE estado=1";

            $result = $conexion->prepare($sql);

            $result->execute();
            // $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function mostrarnombresIns(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM person WHERE rol=3 AND estado =1";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function mostrarnombresIns2($nDoc){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM person 
            WHERE rol=3 AND (estado =1 AND supervisor=$nDoc)";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function mostrarnivel(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM nivel order by nom_nivel asc";

            $result = $conexion->prepare($sql);

            $result->execute();
            // $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

        public function mostrarRubro(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM tiporubro order by nombreRubro asc";

            $result = $conexion->prepare($sql);

            $result->execute();
            // $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }


        public function mostrarambiente(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM ambientes";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

        public function mostrarregion(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM regiones ORDER BY id DESC";

            $result = $conexion->prepare($sql);

            $result->execute();
            // $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

        public function mostrartitu(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT ec.*, j.Nombre AS nombreJornada
            FROM estructura_curricular AS ec
            INNER JOIN jornada AS j ON ec.jornada=j.id
            order by ec.denominacion_prog asc";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

        public function mostrarcompe(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM competencia";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function calendario($nom_even,$nom_per,$fecha) {
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "INSERT INTO calendario (`Nom_evento`, `Nom_per`, `fecha`)
                VALUES (?, ?, ?)";
            $result = $conexion->prepare($sql);
            $result->execute([$nom_even,$nom_per,$fecha]);
            return $result;
        }
        public function mostrardepartamento(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM departamentos";
            $result = $conexion->prepare($sql);

            $result->execute();
            // $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

        public function mostrarmuni(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM municipios";
            $result = $conexion->prepare($sql);

            $result->execute();
            // $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function mostrarmunicipios(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM municipios WHERE iddepar=25";
            $result = $conexion->prepare($sql);

            $result->execute();
            // $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function get_compe($id){
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$sql = "SELECT * FROM competencia WHERE tipoCompetencia=$id ORDER BY nom_competencia ASC";
			$result = $conexion->prepare($sql);
			$result->execute();
			$resultado = $result->fetchall(PDO::FETCH_ASSOC);
			return $resultado;
		}
        public function get_supervisor($id){
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$sql = "SELECT * FROM person WHERE rol=$id ORDER BY nombres ASC";
			$result = $conexion->prepare($sql);
			$result->execute();
			$resultado = $result->fetchall(PDO::FETCH_ASSOC);
			return $resultado;
		}

        public function get_titulacion($id){
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$sql = "SELECT ec.*, j.Nombre AS nombreJornada
            FROM estructura_curricular AS ec
            INNER JOIN jornada AS j ON ec.jornada=j.id
            WHERE ec.nivel=$id ORDER BY ec.denominacion_prog ASC";

			$result = $conexion->prepare($sql);
			$result->execute();
			$resultado = $result->fetchall(PDO::FETCH_ASSOC);
			return $resultado;
		}
      
        public function get_muni($id){
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$sql = "SELECT * FROM municipios WHERE iddepar=$id ORDER BY Nom_municipio ASC";
			$result = $conexion->prepare($sql);
			$result->execute();
			$resultado = $result->fetchall(PDO::FETCH_ASSOC);
			return $resultado;
		}
        public function get_muni2($id){
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$sql = "SELECT * FROM municipios WHERE id_region=$id ORDER BY Nom_municipio ASC";
			$result = $conexion->prepare($sql);
			$result->execute();
			$resultado = $result->fetchall(PDO::FETCH_ASSOC);
			return $resultado;
		}


        public function departamentos(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM departamentos";
            

            $result = $conexion->prepare($sql);

            $result->execute();
            // $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function tDoc(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM tdocumento";
            

            $result = $conexion->prepare($sql);

            $result->execute();
            // $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }



        public function genero(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM genero";
            

            $result = $conexion->prepare($sql);

            $result->execute();
            // $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }


        public function mostrartipocompetencia(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM tipo_competencia";

            $result = $conexion->prepare($sql);

            $result->execute();
            // $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

        public function rol(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM roles";

            $result = $conexion->prepare($sql);

            $result->execute();
            // $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function roles(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM roles";
            
            $result = $conexion->prepare($sql);

            $result->execute();
            // $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function ndoc(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM tdocumento";

            $result = $conexion->prepare($sql);

            $result->execute();
            // $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

        public function mostrarjornada(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM jornada order by id asc";
            

            $result = $conexion->prepare($sql);

            $result->execute();
            // $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

        public function mostrarnombreins(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM ";
            

            $result = $conexion->prepare($sql);

            $result->execute();
            // $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        
        public function editarprog($eNdoc,$nivel,$titulacion,$tipocompetencia,$competencia,$color_evento,$fecha_inicio,$fecha_fin,$z,$rubro,$eambiente) {
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "UPDATE `asignacion_instructor` SET `nDocInstructor`=$eNdoc , `nivel`=$nivel, 
            `nom_titulacion`=$titulacion, `tipocompetencia`=$tipocompetencia, `competencia`=$competencia, 
            `color_evento`='$color_evento',`fecha_inicio`= '$fecha_inicio',`fecha_fin`='$fecha_fin',`rubro`='$rubro', `id_ambiente`=$eambiente WHERE `id`=$z" ;
            $result = $conexion->prepare($sql);
            $result->execute();
            // var_dump($sql);
            // die();
            
            return $result;
        }
        

        public function registrarUsuario($tDoc,$nDoc,$genero,$rol,$correo,$nombres,$apellidos,$nTelefono,$fechaNacimiento,$ncontra,$departamento,$Ciudad,$fechaRegistro,$fechaSession,$fechaContrato,$edit,$reg){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "INSERT INTO person (`T_doc`, `num_doc`, `genero`,`rol`, `Correo`, `nombres`, `apellidos`, `Telefono`, `fechaNacimiento`, `contrasena`, `departamento`, `municipio`, `fechaRegistro`, `fechaSession`, `fechaFinContrato`,`editadoUltimaVez`, `registradoPor`)
             VALUES 
             ($tDoc,$nDoc,$genero,$rol,'$correo','$nombres','$apellidos',$nTelefono,'$fechaNacimiento','$ncontra',$departamento,$Ciudad,'$fechaRegistro','$fechaSession', '$fechaContrato',$edit,$reg)";
            
            //  var_dump($sql);
            //  die();
            $result = $conexion->prepare($sql);
            $result->execute();
            // $resultado = false;
            
            return $result;
            
        }
        public function registrarUsuarioSupervisor($tDoc,$nDoc,$genero,$rol,$correo,$nombres,$apellidos,$nTelefono,$fechaNacimiento,$ncontra,$departamento,$Ciudad,$fechaRegistro,$fechaSession,$fechaContrato,$supervisor,$edit,$reg){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "INSERT INTO person (`T_doc`, `num_doc`, `genero`,`rol`, `Correo`, `nombres`, `apellidos`, `Telefono`, `fechaNacimiento`, `contrasena`, `departamento`, `municipio`, `fechaRegistro`, `fechaSession`, `fechaFinContrato`,`supervisor`,`editadoUltimaVez`, `registradoPor`)
             VALUES 
             ($tDoc,$nDoc,$genero,$rol,'$correo','$nombres','$apellidos',$nTelefono,'$fechaNacimiento','$ncontra',$departamento,$Ciudad,'$fechaRegistro','$fechaSession', '$fechaContrato', $supervisor,$edit,$reg)";
            
            //  var_dump($sql);
            //  die();
            $result = $conexion->prepare($sql);
            $result->execute();
            // $resultado = false;
            
            return $result;
            
        }

        public function consultaPerfiles($p, $nDoc, $fechaRegistro){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "INSERT INTO `perfil_instructor`(`nDocPerfil`, `Titulo`, `fechaRegistro`) VALUES ($nDoc,'$p','$fechaRegistro')";
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result;
        }

        public function editarUsuario($eN2,$eA2,$etDoc,$enDoc,$eRol,$eGenero,$efechaNacimiento,$eCorreo,$eTelefono,$efechaFinContrato,$eDepartamento,$eMunicipio,$editor){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            
            $sql = "UPDATE person SET nombres='$eN2',`apellidos`='$eA2',`T_doc`=$etDoc, `rol`=$eRol, `genero`=$eGenero, 
                    `fechaNacimiento`='$efechaNacimiento', `Correo`='$eCorreo', `Telefono`=$eTelefono, 
                    `fechaFinContrato`='$efechaFinContrato', `departamento`=$eDepartamento, `municipio`=$eMunicipio,
                    `editadoUltimaVez`=$editor  
                    WHERE num_doc=$enDoc";
            
            
            $result = $conexion->prepare($sql);

            $result->execute();
            return $result;
            
        }
        public function editarSupervisor($enDoc,$eSupervisor){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();

            
            $sql = "UPDATE person SET supervisor=$eSupervisor  
                    WHERE num_doc=$enDoc";
            
            
            $result = $conexion->prepare($sql);

            $result->execute();
            return $result;
            
        }

       
        public function instructores(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT per.*, td.Nombre,r.Nombre AS nombreRol,d.nomdepar, nm.Nom_municipio, GROUP_CONCAT(pf.Titulo SEPARATOR '-') AS perfilIns FROM person AS per 
            INNER JOIN tdocumento AS td ON per.T_doc=td.id
            INNER JOIN roles AS r ON per.rol=r.id
            INNER JOIN departamentos AS d ON per.departamento=d.iddpar
            INNER JOIN municipios AS nm ON per.municipio=nm.id 
            INNER JOIN perfil_instructor AS pf ON per.num_doc=pf.nDocPerfil
            WHERE per.rol=3 AND per.estado =1
            GROUP BY per.num_doc";


            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

        public function instructores2($nDoc){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT per.*, td.Nombre,r.Nombre AS nombreRol,d.nomdepar, nm.Nom_municipio, GROUP_CONCAT(pf.Titulo SEPARATOR '-') AS perfilIns FROM person AS per 
            INNER JOIN tdocumento AS td ON per.T_doc=td.id
            INNER JOIN roles AS r ON per.rol=r.id
            INNER JOIN departamentos AS d ON per.departamento=d.iddpar
            INNER JOIN municipios AS nm ON per.municipio=nm.id 
            INNER JOIN perfil_instructor AS pf ON per.num_doc=pf.nDocPerfil
            WHERE per.supervisor= $nDoc AND ( per.rol=3 AND per.estado =1 )
            GROUP BY per.num_doc";


            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

        // consulta de cordinadores
        public function coordinadoresT(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT per.*, td.Nombre, nm.Nom_municipio, r.Nombre FROM person AS per 
            INNER JOIN roles AS r ON per.rol=r.id
            INNER JOIN tdocumento AS td ON per.T_doc=td.id
            INNER JOIN municipios AS nm ON per.municipio=nm.id 
            
            WHERE (per.rol=1 or per.rol=2) AND per.estado=1
            ORDER BY per.rol ASC";

           

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }
        public function tipomensaje(){

            $modelo = new conexion();
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
        public function usuarios(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT p.*, td.Nombre AS nombretd , r.Nombre AS nombrerol, d.nomdepar, m.Nom_municipio, g.nombreGenero FROM person AS p
            INNER JOIN genero AS g ON p.genero=g.id
            INNER JOIN tdocumento AS td ON p.T_doc=td.id
            INNER JOIN roles AS r ON p.rol=r.id
            INNER JOIN departamentos AS d ON p.departamento=d.iddpar
            INNER JOIN municipios AS m ON p.municipio=m.id 
            WHERE p.estado =1 
            ORDER BY p.rol ASC
            ";

           

            $result = $conexion->prepare($sql);

            $result->execute();
            //$resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

        public function perfiles($programa){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT perf.*, ec.denominacion_prog,n.nom_nivel, c.nom_competencia,c.horas, c.resultadosAprendizaje, tc.tipo,p.perfil AS perfilins 
            FROM perf_competencias AS perf 
            INNER JOIN estructura_curricular AS ec ON perf.codigoCurso=ec.codigo_prog
            INNER JOIN nivel AS n ON ec.nivel=n.id
            INNER JOIN competencia AS c ON perf.codifoCompetencia=c.cod_competencia
            INNER JOIN tipo_competencia AS tc ON c.tipoCompetencia=tc.id
            INNER JOIN perfiles AS p ON perf.perfilInstructor=p.id

            where perf.codigoCurso=$programa";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

        public function asignacion(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            $sql="SELECT i.*, nv.nom_nivel,  ap.nombres AS nom,ap.apellidos, dp.denominacion_prog,  tc.tipo, co.nom_competencia, jor.Nombre AS nombreJornada,rub.nombreRubro, am.ambiente
            FROM `asignacion_instructor` AS i
            INNER JOIN nivel AS nv ON i.nivel = nv.id
            INNER JOIN person AS ap ON i.nDocInstructor=ap.num_doc
            INNER JOIN estructura_curricular AS dp ON i.nom_titulacion = dp.codigo_prog
            INNER JOIN tipo_competencia AS tc ON i.tipocompetencia = tc.id
            INNER JOIN jornada AS jor ON dp.jornada=jor.id
            INNER JOIN competencia AS co ON i.competencia=co.cod_competencia
            INNER JOIN tiporubro AS rub ON i.rubro=rub.id
            INNER JOIN ambientes AS am ON i.id_ambiente=am.id
            ORDER BY i.fecha_inicio DESC";
            

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

        public function asignacion2($nDoc){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            $sql="SELECT i.*, nv.nom_nivel,  ap.nombres AS nom,ap.apellidos, dp.denominacion_prog,  tc.tipo, co.nom_competencia, jor.Nombre AS nombreJornada , rub.nombreRubro, am.ambiente
            FROM `asignacion_instructor` AS i
            INNER JOIN nivel AS nv ON i.nivel = nv.id
            INNER JOIN person AS ap ON i.nDocInstructor=ap.num_doc
            INNER JOIN estructura_curricular AS dp ON i.nom_titulacion = dp.codigo_prog
            INNER JOIN tipo_competencia AS tc ON i.tipocompetencia = tc.id
            INNER JOIN jornada AS jor ON dp.jornada=jor.id
            INNER JOIN competencia AS co ON i.competencia=co.cod_competencia 
            INNER JOIN tiporubro AS rub ON i.rubro=rub.id
            INNER JOIN ambientes AS am ON i.id_ambiente=am.id
            WHERE i.nDocRegistradoPor = $nDoc
            ORDER BY i.fecha_inicio DESC";
            

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

        public function editarUsuarioone($idUser){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT p.*, td.Nombre AS nombretd FROM person AS p
            INNER JOIN tdocumento AS td ON p.T_doc=td.id WHERE p.id=$idUser";
        
            $result = $conexion->prepare($sql);

            $result->execute();
            // $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
            
        }

        public function traerSupervisores($rol,$nDoc){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM person WHERE rol=$rol AND num_doc!=$nDoc";
        
            $result = $conexion->prepare($sql);

            $result->execute();
            // $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
            
        }

          public function eliminar_asig($idprog){

            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
        
            $sql = "DELETE FROM asignacion_instructor WHERE id=$idprog";
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result;

          }
          public function editarasig($id){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM asignacion_instructor WHERE id=$id";

            // $sql = "SELECT ec.*, n.nom_nivel
            // FROM `estructura_curricular` AS ec 
            // INNER JOIN nivel AS n ON ec.nivel=n.id
            // WHERE ec.codigo_prog=$programa";
            
            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
            
        }
        public function compes_buscar($tc){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM competencia WHERE tipoCompetencia=$tc";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
            
        }
         public function guardar_carga_masiva_usuario($sqln){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql=$sqln;
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result;
          }

        public function guardarCargaMasivaPerfil($contraCarga,$value2,$fechaRegistro){

            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
        
            $sql = "INSERT INTO perfil_instructor (`nDocPerfil`, `Titulo`, `fechaRegistro`) VALUES 
            ($contraCarga,'$value2','$fechaRegistro')";
            // var_dump($sql);
            // die();
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result;

          }

          public function actualizar_foto($rutafinalSql,$nDoc){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql="UPDATE person SET foto='$rutafinalSql' WHERE nDoc=$nDoc;";
            $result = $conexion->prepare($sql);
            $result->execute();

          }
           public function get_depa(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM departamentos ORDER BY nombreDepartamento ASC";

            $result = $conexion->prepare($sql);

            $result->execute();
            // $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

     




 


        public function programas(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM estructura_curricular";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

        // consulta que trae los datos  de asignaciones para la grafica
        public function asignaciones(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM `asignacion_instructor`";
            

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
            
        }
        // consulta que trae los datos registrados para la grafica
        public function registros(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM `person`";
            

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
            
        }
         // consulta que trae los datos de los inicios de sesion para la grafica
         public function sesion(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM `iniciosession`";
            

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
            
        }

        // consulta que trae los datos  de asignaciones para la grafica
        public function asignacionesCoordinador(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM `asignacion_instructor`";
            

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
            
        }
        public function nuevocurso($codigo,$version,$nombre,$nivel,$jornada,$descripcion,$region,$municipio){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "INSERT INTO `estructura_curricular`(`codigo_prog`, `version`, `denominacion_prog`, `nivel`,`jornada`, `descripcion`,`region`, `municipio`)
             VALUES ($codigo,$version,'$nombre',$nivel,$jornada,'$descripcion',$region,$municipio)";
            
            $result = $conexion->prepare($sql);

            $result->execute();
            // // $resultado = false;
            // while($f=$result->fetch()){
            //     $resultado[]=$f;
            // }
            return $result;
        }

        public function nuevacompetencia($tCompetencia,$codigocompe,$nombrecompe,$cHoras,$rAprendizaje){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "INSERT INTO `competencia`( `cod_competencia`, `nom_competencia`, `tipoCompetencia`, `horas`, `resultadosAprendizaje`) 
            VALUES ($codigocompe, '$nombrecompe', $tCompetencia, $cHoras, $rAprendizaje)";
            

            $result = $conexion->prepare($sql);

            $result->execute();

            return $result;
        }

        public function asignacioncompetencia($codigocursoasignado,$tipocompe,$compeasignada,$tipoperfilasignada){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "INSERT INTO `perf_competencias`( `codigoCurso`, `codifoCompetencia`, `Tipocompetencia`, `perfilInstructor`)
             VALUES ($codigocursoasignado,$compeasignada,$tipocompe,$tipoperfilasignada)";
            
            $result = $conexion->prepare($sql);

            $result->execute();
            // // $resultado = false;
            // while($f=$result->fetch()){
            //     $resultado[]=$f;
            // }
            return $result;
        }


        public function cursoseleccionado($programa){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM `estructura_curricular` WHERE codigo_prog=$programa";
            

            $result = $conexion->prepare($sql);

            $result->execute();
            // $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
            
        }
        public function cursoseleccionado2($programa){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT ec.*, n.nom_nivel
            FROM `estructura_curricular` AS ec 
            INNER JOIN nivel AS n ON ec.nivel=n.id
            WHERE ec.codigo_prog=$programa";

            $result = $conexion->prepare($sql);

            $result->execute();
            // $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
            
        }

        public function Competenciascursos(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM `competencia`";

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
        }

        public function perfilesinstrutores(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM `perfiles`";
            

            $result = $conexion->prepare($sql);

            $result->execute();
            //$resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
            
        }
        public function cursos(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            $sql = "SELECT ec.*, n.nom_nivel, j.Nombre AS nombreJornada
            FROM `estructura_curricular` AS ec 
            INNER JOIN nivel AS n ON ec.nivel=n.id 
            INNER JOIN jornada AS j ON ec.jornada=j.id
            ORDER BY ec.nivel ASC, ec.codigo_prog ASC";


            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
            
        }
        public function contacto(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            $sql = "SELECT * FROM contacto WHERE estado=1 ORDER BY fechaRegistro DESC";


            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
            
        }
        public function competencias(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            
            $sql = "SELECT c.*, tc.tipo
            FROM `competencia` AS c 
            INNER JOIN tipo_competencia AS tc ON c.tipoCompetencia=tc.id 
            ORDER BY c.tipoCompetencia ASC, c.cod_competencia ASC";


            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
            
        }
        public function tipoCompe(){
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT * FROM `perfiles`";
            

            $result = $conexion->prepare($sql);

            $result->execute();
            $resultado = false;
            while($f=$result->fetch()){
                $resultado[]=$f;
            }
            return $resultado;
            
        }
        public function eliminarcompetencia($compeborrada){

            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $sql = "DELETE FROM perf_competencias WHERE id=$compeborrada";
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result;

        }




// consulta grafica Instructor numero de asignaciones


    public function asignaciones_ins($nDoc){
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $sql = "SELECT * FROM `asignacion_instructor` WHERE nDocInstructor=$nDoc;";
        

        $result = $conexion->prepare($sql);

        $result->execute();
        $resultado = false;
        while($f=$result->fetch()){
            $resultado[]=$f;
        }
        return $resultado;
        
    }

        // consultas de graficas de total de cursos segun cada jornada

    // jornada mañana (1)
    public function cursos_mañana(){
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $sql = "SELECT nivel.nom_nivel,(SELECT count(*) FROM estructura_curricular WHERE nivel=nivel.id AND jornada=1) AS total FROM nivel;";
        

        $result = $conexion->prepare($sql);

        $result->execute();
        $resultado = [];
        while($f=$result->fetch()){
            $resultado[]=$f;
        }
        return $resultado;
        
    }
     // jornada tarde (2)
     public function cursos_tarde(){
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $sql = "SELECT nivel.nom_nivel,(SELECT count(*) FROM estructura_curricular WHERE nivel=nivel.id AND jornada=2) AS total FROM nivel;";
        

        $result = $conexion->prepare($sql);

        $result->execute();
        $resultado = [];
        while($f=$result->fetch()){
            $resultado[]=$f;
        }
        return $resultado;
        
    }

     // jornada noche (3)
     public function cursos_noche(){
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $sql = "SELECT nivel.nom_nivel,(SELECT count(*) FROM estructura_curricular WHERE nivel=nivel.id AND jornada=3) AS total FROM nivel;";
        

        $result = $conexion->prepare($sql);

        $result->execute();
        $resultado = [];
        while($f=$result->fetch()){
            $resultado[]=$f;
        }
        return $resultado;
        
    }

      // jornada fin de semana (4)
      public function cursos_fin_semana(){
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $sql = "SELECT nivel.nom_nivel,(SELECT count(*) FROM estructura_curricular WHERE nivel=nivel.id AND jornada=4) AS total FROM nivel;";
        

        $result = $conexion->prepare($sql);

        $result->execute();
        $resultado = [];
        while($f=$result->fetch()){
            $resultado[]=$f;
        }
        return $resultado;
        
    }
    
      // jornada virtual (5)
      public function cursos_virtual(){
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $sql = "SELECT nivel.nom_nivel,(SELECT count(*) FROM estructura_curricular WHERE nivel=nivel.id AND jornada=5) AS total FROM nivel;";
        

        $result = $conexion->prepare($sql);

        $result->execute();
        $resultado = [];
        while($f=$result->fetch()){
            $resultado[]=$f;
        }
        return $resultado;
        
    }

    }
?>