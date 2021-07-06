<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("location: index.php");
}
include "../banco/banco.php";
$conn = connect();
$id = $_GET['user'];
//recebendo os resultados das consultas
$resultado = consultaUser($conn, $id);

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
    <title>Título</title>
</head>

<body>
    <div class="app">
        <?php
        include "../navbar.php";
        nav();
        ?>
        <div class="column is-12 is-offset-3">
            <div class="column is-6">
                <div class="card">
                    <h1 class="title">Formulário de Atualização</h1>
                    <form action="update.php?type=cli&user=<?php echo $id; ?>" method="POST">
                        <div class="field">
                            <label class="label"><i class="far fa-id-card"></i> Nome</label>
                            <div class="control is-white">
                                <input value="<?php echo $resultado['nome']; ?>" required name="nome" class="input" type="text" placeholder="Nome Completo">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label"><i class="fa fa-at"></i> Email</label>
                            <div class="control is-white">
                                <input value="<?php echo $resultado['email']; ?>" required class="input" type="email" name="email" placeholder="Endereço de email">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label"><i class="fab fa-whatsapp-square"></i> Telefone</label>
                            <div class="control is-white">
                                <input value="<?php echo $resultado['telefone']; ?>" maxlength="11" required class="input" type="text" name="telefone" placeholder="(00) 00000 0000">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label"><i class="fas fa-address-card"></i> CNPJ</label>
                            <div class="control is-white">
                                <input value="<?php echo $resultado['cnpj']; ?>" maxlength="8" required class="input" type="text" name="cnpj" placeholder="cnpj">
                            </div>
                        </div>
                        <div class="field">
                            <?php
                            if ($resultado['user_type'] == "admin") { ?>
                                <input class="input" disabled type="text" name="user_type" value="<?php echo $resultado["user_type"]; ?>">
                            <?php
                            } else { ?>
                                <label class="label"><i class="far fa-address-card"></i> Fornecedor</label>
                                <div class="select">
                                    <select name="user_type" id="">
                                        <optgroup label="Fornecedor">
                                            <option value="user" checkd>
                                                usuário
                                            </option>
                                            <option value="admin">
                                                administrador
                                            </option>
                                        </optgroup>
                                    </select>
                                <?php
                            }
                                ?>
                                </div><br>
                                <button class="button is-link" type="submit">Enviar</button>
                                <input type="reset" class="button is-warning is-light">
                    </form>
                    </vr>
                </div>
            </div>
        </div>
    </div>
    <?php
    include "../footer.php";
    rodape();
    ?>
</body>

</html>