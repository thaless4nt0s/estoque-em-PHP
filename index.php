<?php
    //Verificando a sessão do usuário
    session_start();
    if(isset($_SESSION['admin'])){
        header('location: admin/admin.php');
    }else if(isset($_SESSION['user'])){
        header('location: user/user.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque</title>
    <link rel="stylesheet" href="node_modules/bulma/css/bulma.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="font awesome/css/all.min.css">
</head>
<body>
    <div class="app is-widescreen is-fullscreen">
        <div class="column is-12 is-offset-3">
            <div class="column is-6">
                <div class="card">
                <h1 class="title">Formulário de Login</h1>
                    <form action="banco/login.php" method="POST" >
                        <div class="field">
                            <label class="label"><i class="fa fa-at"></i> Email</label>
                            <div class="control is-white">
                                <input required class="input" type="email" name="email" placeholder="Endereço de email">
                            </div>
                        </div>
                        <div class="field">
                            <label  class="label"><i class="fa fa-key"></i> Senha</label>
                            <div class="control is-white">
                                <input required name="senha" class="input" type="password" placeholder="senha">
                            </div>
                        </div>
                        <button class="button is-link" type="submit">Enviar</button>
                        <input type="reset" class="button is-warning is-light">
                    </form>
                    <a class="botao" href="banco/cadastro.php"><button id="botao" class="button is-success">Criar conta</button></a>
                    <?php
                        //Verificando se o usuário entrou com alguma credencial incorreta, caso tenha entrado
                        // Uma modal irá surgir avisando que ele entrou com a mensagem "Usuario e/ou senha incorretos"
                        if(isset($_GET['error']) && $_GET['error'] == "user"){ ?>
                            <div class="notification is-danger">
                            <button class="delete has-text-center"><a href="index.php"></a></button>
                                Erro, e-mail e/ou senha incorreto(s)
                            </div>
                    <?php } ?> 
                </div>
            </div>
        </div>            
    </div>
    <?php
        include "footer.php";
        rodape();
    ?>
</body>
</html>