<?php
    include("../models/mconsultas.php");
   
    $consulta = new Consultas(); // Objecto
    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Si no está iniciada, la iniciamos
        session_start();
    }
    // var_dump("Hola");
    // die();
    if(isset($_GET['M'])){   
        $file = "../Manuales/" . $_SESSION['rol'] . ".pdf";
        // echo $file;
        // die();
        if (is_file($file)) {
          $filename = "Manual_de_uso.pdf"; // el nombre con el que se descargará, puede ser diferente al original
          /*header("Content-Type: application/octet-stream");*/
          header("Content-Type: application/force-download");
          header("Content-Disposition: attachment; filename=\"$filename\"");
          readfile($file);
        } else {
          die("Error: no se encontró el archivo '$file'");
        }    
    }

    if(isset($_GET['N'])){   
      $file = "../Manuales/0.pdf";
      if (is_file($file)) {
        $filename = "Manual_de_uso.pdf"; // el nombre con el que se descargará, puede ser diferente al original
        /*header("Content-Type: application/octet-stream");*/
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        readfile($file);
      } else {
        die("Error: no se encontró el archivo '$file'");
      }    
  }

?>