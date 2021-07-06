<div class="app">
        <div class="card">
            <h1 class="title">Cadastrar Produto</h1>
            <form action="../banco/cad.php?type=prod" method="POST">
                <div class="field">
                    <label class="label"><i class="fa fa-at"></i> Nome</label>
                    <div class="control is-white">
                        <input required class="input" type="text" name="nome">
                    </div>
                </div>
                <div class="field">
                    <label class="label"><i class="fas fa-dollar-sign"></i> preco</label>
                    <div class="control is-white">
                        <input required name="preco" class="input" type="text">
                    </div>
                </div>

                <div class="field">
                    <label class="label"><i class="fas fa-tally"></i> Quantidade</label>
                    <div class="control is-white">
                        <input required name="quantidade" class="input" type="text">
                    </div>
                </div>
                <label class="label"><i class="far fa-address-card"></i> Fornecedor</label>
                <div class="select">
                    <select name="fornecedor" id="">
                        <optgroup label="Fornecedor">
                            <?php
                            include "../banco/banco.php";
                            $conn = connect();
                            $query = "SELECT id,nome FROM tb_user WHERE nome = '".$_SESSION['user']."'";
                            $res = mysqli_query($conn, $query);
                            while ($resposta = mysqli_fetch_array($res)) {
                            ?>
                                <option checked value="<?php echo $resposta['id']; ?>">
                                    <?php echo $resposta['nome']; ?>
                                </option>
                        </optgroup>
                    <?php
                        }
                    ?>
                    </select>
                </div>
                <button class="button is-link" type="submit">Enviar</button>
                <input type="reset" class="button is-warning is-light">
            </form>
        </div>