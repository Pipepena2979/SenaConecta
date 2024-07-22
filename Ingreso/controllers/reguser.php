<?php
 include("../models/mconsultas.php");
   
 $consulta = new Consultas(); // Objecto

 $tDocs = $consulta->tDoc();
 $ndoc = $consulta->ndoc();
 $rol = $consulta->roles();
 $muni = $consulta->mostrarmuni();
 $departamento = $consulta->mostrardepartamento();

 if(isset($_POST['tdoc'])){
    $tdocumento= (isset($_POST['tdoc']) ? $_POST['tdoc']:NULL);
    $ndoc=(isset($_POST['ndoc']) ? $_POST['ndoc']:NULL);
    $nombres= (isset($_POST['name']) ? $_POST['name']:NULL);
    $ntelefono = (isset($_POST['ntel']) ? $_POST['ntel']:NULL);
    $email = (isset($_POST['email']) ? $_POST['email']:NULL);
    $contraseña = (isset($_POST['contra']) ? $_POST['contra']:NULL);
    $rol = (isset($_POST['rol']) ? $_POST['rol']:NULL);
    $perfil = (isset($_POST['perfil']) ? $_POST['perfil']:NULL);
    $municipio = (isset($_POST['municipio']) ? $_POST['municipio']:NULL);
    
    $saveUser = $consulta->guardar_usuario($tdocumento,$ndoc,$rol,$email,$nombres,$perfil,$ntelefono,$contraseña,$municipio);
        
    if($saveUser){
        if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
            session_start();
        }
        $_SESSION['tipo_alert']="success";
        $_SESSION['mensaje']=" asignacion realizada ";
        echo "<script>location.href='../views/registrousuarios.php'</script>";
    }
}
?>