<?php
    //incluindo os arquivos necessários
    include "banco.php";

    $conn = connect();//conectando com o banco de dados
    var_dump($_POST);
    
    login($conn, $_POST['email'],md5($_POST['senha'])); // Realizando o login login($conexão,$email,$senha);
    
    //var_dump($_SESSION);
        
    if(isset($_SESSION['admin'])){
        header('location: ../admin/admin.php');
    }else if($_SESSION['user']){
        header("location: ../user/user.php");
    }else{
        header("location: ../index.php?error=user");
    }
?>