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
    //$user=null;
    ////////
    include "templates/pie.php";
    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1></h1>
    <h2></h2>
</body>
</html>