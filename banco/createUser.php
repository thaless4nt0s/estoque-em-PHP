<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../node_modules/bulma/css/bulma.min.css">
    <link rel="stylesheet" href="../font awesome/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>Título</title>
</head>

<body>
<div class="column is-12 is-offset-3">
    <div class="column is-6">
        <div class="card">
        <h1 class="title">Formulário Cadastro</h1>
            <form action="cad.php?type=user" method="POST" >
                <div class="field">
                    <label  class="label"><i class="far fa-id-card"></i> Nome</label>
                    <div class="control is-white">
                        <input required name="nome" class="input" type="text" placeholder="Nome Completo">
                    </div>
                </div>

                <div class="field">
                    <label class="label"><i class="fa fa-at"></i> Email</label>
                    <div class="control is-white">
                        <input required class="input" type="email" name="email" placeholder="Endereço de email">
                    </div>
                </div>

                <div class="field">
                    <label class="label"><i class="fab fa-whatsapp-square"></i> Telefone</label>
                    <div class="control is-white">
                        <input maxlength="11" required class="input" type="text" name="telefone" placeholder="(00) 00000 0000">
                    </div>
                </div>

                <div class="field">
                    <label class="label"><i class="fas fa-address-card"></i> CNPJ</label>
                    <div class="control is-white">
                        <input maxlength="8" required class="input" type="text" name="cnpj" placeholder="cnpj">
                    </div>
                </div>
                <div class="field">
                    <label  class="label"><i class="fa fa-key"></i> Senha</label>
                    <div class="control is-white">
                        <input maxlength="8" minlength="8" required name="senha" class="input" type="password" placeholder="senha">
                    </div>
                </div>
                <div class="select">
                    <select name="user_type" id="">
                        <optgroup label="Tipo de usuário">
                            <option value="user">Usuário</option>
                            <option value="admin">Administrador</option>
                        <optgroup>
                    </select>
                </div><br>
                <button class="button is-link" type="submit">Enviar</button>
                <input type="reset" class="button is-warning is-light">
                <br>

                <?php
                    //Verificando se o usuário entrou com alguma credencial incorreta, caso tenha entrado
                    // Uma modal irá surgir avisando que ele entrou com a mensagem "Usuario e/ou senha incorretos"
                    if(isset($_GET['error']) && $_GET['error'] == "email"){ ?>
                        <div class="notification is-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                            <p>Erro, e-mail e já existente !!!</p>
                        </div>
                <?php } ?> 

            </form>
            </vr>
            
        </div>
    </div>
</div>            
    <?php
    include "../footer.php";
    rodape();
    ?>
</body>
</html>