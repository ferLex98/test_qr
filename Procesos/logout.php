<?php
    require "../config.php";
    session_start();
    //destruye las sesiones echas
    session_destroy();
    header("location: ".urlsite);
?>