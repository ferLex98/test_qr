<?php
    session_start();
    include "config.php";
    ////Esto es para la conexion a todas las paginas//
    require "class/conexion.php";
    $user=new ApptivaDB();
    ///////
    include "templates/cabecera.php";
    if(isset($_SESSION['administrador'])){
        $pagina=(isset($_GET['pagina']))?$_GET['pagina']: "index";
    }else{
        $pagina="login";
    }
    include "paginas/".$pagina.".php";
    ////se cierra la conexion
    $user=null;
    ////////
    include "templates/pie.php";
    
?>
