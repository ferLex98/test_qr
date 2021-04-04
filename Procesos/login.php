<?php
    session_start();
    require "../config.php";
    $mensaje="No se pudo acceder";
    if(isset($_POST['btnlogin'])):
        //consulta a la bdd
        require "../class/conexion.php";
        $user = new ApptivaDB();
        ///////////////////////////
        $email= $_POST['txtemail'];
        $password= md5($_POST['txtpassword']);
        ////////////////////////
        $data = "email='".$email."'AND password='".$password."'";
        $u=$user->buscar("login",$data);
        if($u):
            foreach($u as $data):
                $_SESSION['administrador']= $data['id'];
                $mensaje=$data['nombre'];
            endforeach;
        endif;
    endif;
    ///var_dump($_REQUEST);//Trae todas las variables digitadas
    header("location: ".urlsite."?mensaje=".$mensaje);
?>