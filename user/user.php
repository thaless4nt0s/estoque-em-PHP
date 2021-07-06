<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../node_modules/bulma/css/bulma.min.css">
    <link rel="stylesheet" href="../font awesome/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <title><?php echo $_SESSION['user']; ?></title>
</head>

<body>
    <div class="app is-widescreen is-fullscreen">
        <?php
        include "../navbar.php";
        nav2();
        ?>
    </div>

    <div class="app is-widescreen is-fullscreen">

        <?php
        if (isset($_GET['list'])) {
            if ($_GET['list'] == "prod") {
        ?>
                <h1 id="tabela" class="title">Meus Produtos</h1>
                <br>
                <table class="table">
                    <thead>
                        <th>Nome</th>
                        <th>Preço (R$)</th>
                        <th>Quantidade</th>
                        <th>Ações</th>
                    </thead>
                    <tbody>
                        <?php
                        include "../banco/banco.php";
                        include "../banco/botoes.php";
                        $conn = connect();
                        $nome = $_SESSION['user'];
                        $query = "SELECT id FROM tb_user WHERE nome = '$nome'";
                        $res = mysqli_query($conn, $query);
                        $id = mysqli_fetch_assoc($res);
                        $query = "SELECT id,nome ,quantidade,preco FROM tb_produtos WHERE id_user =". $id['id'];
                        $res = mysqli_query($conn,$query);
                        while($resultado = mysqli_fetch_assoc($res)){
                            echo "<tr>";
                                echo "<td>";
                                    echo ucfirst($resultado ['nome']);
                                echo "</td>";

                                echo "<td>";
                                    echo $resultado ['preco']." R$";
                                echo "</td>";

                                echo "<td>";
                                    echo ucfirst($resultado ['quantidade'])." un";
                                echo "</td>";
                                
                                echo "<td>";    
                                    buttonsProd($resultado['id']);
                                echo "</td>";

                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
        <?php
            } else if ($_GET['list'] == "cad") {
                include "form.php";
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