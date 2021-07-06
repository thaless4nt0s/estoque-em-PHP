<?php
    //echo "<pre>";
    //var_dump($_POST);
    //echo "</pre>";
    
    //Se o tipo de usuário estiver setado
    if(isset($_GET['type'])){
        include "banco.php";
        $conn = connect();
        //Se o tipo for usuário, irei inserir na tabela de usuarios
        if($_GET['type'] == "user"){
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = md5($_POST['senha']);
            $cnpj = $_POST['cnpj'];
            $telefone = $_POST['telefone'];
            $user_type = $_POST['user_type'];
            //Criando o usuário  $conn,$tabela,$nome,$email,$senha,$cnpj, $telefone
            createUser($conn,$nome,$email,$senha,$cnpj,$telefone,$user_type);
        }else if($_GET['type'] == "prod"){
            //Colocando os dados na funcao para criar um produto
            createProd($conn,$_POST);
                
        }
    }


?>