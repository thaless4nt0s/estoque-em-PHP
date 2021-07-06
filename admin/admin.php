<?php
    //Verificando a sessão do usuario
    session_start();
    if (!isset($_SESSION['admin'])) {
        header('location: ../index.php');
    } else if (isset($_SESSION['user'])) {
        header('location: ../user/user.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../node_modules/bulma/css/bulma.min.css">
    <link rel="stylesheet" href="../font awesome/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>Estoque</title>
</head>

<body>
    <div class="app is-widescreen is-fullscreen">
        <?php
            include "../navbar.php";
            nav();
        ?>
    </div>
    <div class="app">

            <?php
                include_once "../banco/banco.php";
                $conn = connect();
                /*
                    Se for == "cli" -> Lista de clientes
                    Se for == "Prod" -> Lista de Produtos
                    Se for == "Del" -> Deletar produto
                    Se for == "create" -> Criar cliente ou produto
                */
                if(isset($_GET['list'])){
                    if($_GET['list'] == 'cli'){
                        echo '<h1 id="tabela" class="title">Lista de Fornecedores</h1>';
                        mostrar($conn,'tb_user',NULL);
                    }else  if($_GET['list'] == "prod"){
                        mostrar($conn,'tb_produtos',NULL);
                    }
                }
                if(isset($_GET['ok'])){
                    if($_GET['ok'] == "prodOk"){
                        echo '<div class="notification is-success is-light">
                        <button class="delete"></button>
                            Um elemento foi atualizado/cadastrado com sucesso !!!
                        </div>';
                    }
                }
            ?>
    </div>
    <?php
    include "../footer.php";
    rodape();
    ?>

</body>

</html>