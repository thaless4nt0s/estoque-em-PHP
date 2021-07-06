<?php
    //Esta funcao é exclusivamente usada para o administrador
    function nav(){
?>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="https://versions.bulma.io/0.7.0">
                <img src="https://versions.bulma.io/0.7.0/images/bulma-logo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div class="navbar-item">
            <div class="field is-grouped">
                <p class="control">
                    <a class="button" href="admin.php?list=cli">
                        <span class="icon">
                            <i class="fas fa-list" aria-hidden="true"></i>
                        </span>
                        <span>Lista de Fornecedores</span>
                    </a>
                </p>
                <p class="control">
                    <a class="button is-primary is-light" href="admin.php?list=prod">
                        <span class="icon">
                            <i class="fas fa-list" aria-hidden="true"></i>
                        </span>
                        <span>Lista de Produtos</span>
                    </a>
                </p>
            </div>
        </div>
        <div class="navbar-item">
            <div class="field is-grouped">
                <p class="control">
                    <a class="button is-success is-light" href="../banco/createProd.php">
                        <span class="icon">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span>Adicionar Produto</span>
                    </a>
                </p>
            </div>
        </div>
        <div class="navbar-item">
            <div class="field is-grouped">
                <p class="control">
                    <a class="button is-success is-light" href="../banco/createUser.php">
                        <span class="icon">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span>Adicionar Fornecedor</span>
                    </a>
                </p>
            </div>
        </div>
        <div class="navbar-item">
            <div class="field is-grouped">
                <p class="control">
                    <a class="button is-success is-light" href="../auditoria/index.php">
                        <span class="icon">
                        <i class="fas fa-list-alt"></i>
                        </span>
                        <span>Auditoria</span>
                    </a>
                </p>
            </div>
        </div>
        <div class="navbar-item">
            <div class="field is-grouped">
                <p class="control">
                    <a class="button" href="../banco/logout.php">
                        <span class="icon">
                            <i class="fas fa-power-off"></i>
                        </span>
                        <span>Logout</span>
                    </a>
                </p>
            </div>
        </div>
    </nav>
<?php
}

//Funcao para a navBar exclusivamenta para o uso do usuário
    function nav2(){ ?>
        <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="https://versions.bulma.io/0.7.0">
                <img src="https://versions.bulma.io/0.7.0/images/bulma-logo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div class="navbar-item">
            <div class="field is-grouped">
                <p class="control">
                    <a class="button" href="user.php?list=prod">
                        <span class="icon">
                            <i class="fas fa-list" aria-hidden="true"></i>
                        </span>
                        <span>Meus Produtos</span>
                    </a>
                </p>
                <p class="control">
                    <a class="button is-primary is-light" href="user.php?list=cad">
                        <span class="icon">
                            <i class="fas fa-list" aria-hidden="true"></i>
                        </span>
                        <span>Cadastrar Produto</span>
                    </a>
                </p>
            </div>
        </div>
        <div class="navbar-item">
            <div class="field is-grouped">
                <p class="control">
                    <a class="button" href="../banco/logout.php">
                        <span class="icon">
                            <i class="fas fa-power-off"></i>
                        </span>
                        <span>Logout</span>
                    </a>
                </p>
            </div>
        </div>
    </nav>
<?php
    }
?>