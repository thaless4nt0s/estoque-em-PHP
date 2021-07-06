<?php
    //Incluindo o arquivo do banco de dados e de deletar
    include "banco.php";
    $conn = connect();
    //Se estiver setado, irá entrar neste if
    if(isset($_GET['user'])){
        
        $id = $_GET['user'];
        deleteUser($conn,$id);
        header("location: ../admin/admin.php?list=cli");
        
    }


?>