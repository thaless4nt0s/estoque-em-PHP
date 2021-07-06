<?php
    //incluindo os arquivos necessarios
    include "banco.php";
    //Realizando a conexao com o banco de dados
    $conn = connect();
    if(isset($_GET['user'])){
        $id = $_GET['user'];
        //Deletando um produto
        deleteProd($conn,$id);
    }

?>