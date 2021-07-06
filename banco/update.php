<?php
    include "banco.php";
    $conn = connect();
    if(!isset($_GET['type'])){
        header("location: ../admin/admin.php?list=prod");

    }else if($_GET['type'] == "prod"){//Se o tipo for produto
        //funcao para atualizar oo produto
        //1°par(conexao) 2°par(formulario) 
        /*
            array(5):
                ["id"]=> //ID DO PRODUTO
                string(2) "28"
                ["nome"]=> //NOME DO PRODUTO
                string(14) "Papel Queimado"
                ["preco"]=> // PRECO DO PRODUTO
                string(4) "3.99"
                ["quantidade"]=> //QUANTIDADE DE PRODUTOS
                string(2) "10"
                ["fornecedor"]=> // ID DO FORNECEDOR (tb_user.id)
                string(2) "20"
            :
        */    
        updateProd($conn,$_POST);
        header("location: ../admin/admin.php?ok=prodOk");
    }else if($_GET['type'] == "cli"){//Caso o tipo seja cliente, 
        //funcao para atualizar o cliente
        updateUser($conn,$_POST,$_GET['user']);
        header("location: ../admin/admin.php?ok=prodOk");
    }
    
?>