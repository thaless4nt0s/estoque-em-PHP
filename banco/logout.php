<?php
    include "../auditoria/auditoria.php";
    $GLOBALS['arquivo'] = createFile();
    $txt = "";
    session_start();
    if(isset($_SESSION['admin'])){
        $txt = "O usuário ".$_SESSION['admin']." saiu do sistema";
    }else if(isset($_SESSION['user'])){
        $txt = "O usuário".$_SESSION['user']." saiu do sistema";
    }
    session_destroy();
    escrever($txt,$GLOBALS['arquivo']);
    header("location: ../index.php");

?>