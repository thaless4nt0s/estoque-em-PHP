<?php
session_start();
include "banco.php";
if ((isset($_GET['user']) or isset($_SESSION['admin'])) and $_GET['user']) {
    $conn = connect();
    //Realiza a consulta para pegar o conteudo de um determinado produto 
    $resultado = consultaProd($conn, $_GET['user']);
} else {
    header('location: admin.php?list=prod');
}
/*
*/

//Verificando a sessão do usuario

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
        <div class="card">
            <h1 class="title">Formulário de Atualização</h1>
            <form action="update.php?type=prod" method="POST">
            <input type="hidden" name="id" value="<?php echo $resultado['id']; ?>">
                <div class="field">
                    <label class="label"><i class="fa fa-at"></i> Nome</label>
                    <div class="control is-white">
                        <input required class="input" type="text" name="nome" value="<?php echo $resultado['nome']; ?>">
                    </div>
                </div>
                <div class="field">
                    <label class="label"><i class="fas fa-dollar-sign"></i> preco</label>
                    <div class="control is-white">
                        <input required name="preco" class="input" type="text" value="<?php echo $resultado['preco']; ?>">
                    </div>
                </div>

                <div class="field">
                    <label class="label"><i class="fas fa-tally"></i> Quantidade</label>
                    <div class="control is-white">
                        <input required name="quantidade" class="input" type="text" value="<?php echo $resultado['quantidade']; ?>">
                    </div>
                </div>
                
                <?php
                    if(isset($_SESSION['admin'])){
                ?>
                <label class="label"><i class="far fa-address-card"></i> Fornecedor</label>
                <div class="select">
                    <select name="fornecedor" id="">
                        <optgroup label="Fornecedor">
                            <?php
                            $query = "SELECT id,nome FROM tb_user WHERE user_type = 'user'";
                            $res = mysqli_query($conn, $query);
                            while ($resposta = mysqli_fetch_array($res)) {
                            ?>

                                <option value="<?php echo $resposta['id']; ?>">
                                    <?php echo $resposta['nome']; ?>
                                </option>
                        </optgroup>
                    <?php
                            }
                    ?>
                    </select>
                </div>
                <?php
                    }else{
                ?>
                
                <input name="fornecedor" class="input" type="hidden" value="<?php echo $resultado['id_user']; ?>">
                <?php
                    }
                ?>
                <button class="button is-link" type="submit">Enviar</button>
                <input type="reset" class="button is-warning is-light">
            </form>
        </div>

        <?php
        include "../footer.php";
        rodape();
        ?>

</body>

</html>