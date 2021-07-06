<?php
/**
    *@author: thales da Silva Santos
    *Página que irá gerenciar todo  o banco de dados do sistema de estoque
    *@date: 13/04/2021
**/
/*
    BANCO DE DADOS:
    TABELA `tb_user` 
    |    id           |              
    |    nome         |   
    |    email        | 
    |    senha -> md5 |
    |    cnpj         | 
    |    telefone     | 
    |    user_type    |
-==-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=--==--=-=-=   
    TABELA `tb_produtos` 
    |    id           |              
    |    nome         |   
    |    preco        | 
    |    quantidade   |
    |    id_user      | 
-==-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=--==--=-=-=  
*/

    //Inserindo o arquivo de auditoria
    //Para mostrar o que os usuários estão fazendo
    include "../auditoria/auditoria.php";
    //O arquivo será umma variavel globar, pois, não quero modificar todas as funcoes
    $GLOBALS['arquivo'] = createFile();


    //Função que irá se conectar com o banco de dados
    function connect(){
        $hostname = "127.0.0.1";
        $username = "root";
        $password = "";
        $db_name = "db_estoque";
        $conn = mysqli_connect($hostname,$username,$password,$db_name);

        if(mysqli_connect_errno()){
            echo("Falha ao conectar com o banco de dados !!\n".mysqli_connect_error());
            exit();
        }
        //echo("Conectado com sucesso\n");

        //retornando a conexão, caso ela seja estabelecida com sucesso
        return $conn;
    }// FIM DA FUNCAO CONNECT
    
    //Função para validar o login de um usuário 
    function login($conn, $email,$senha){
        //A senha já é passada em MD5 nos parametros
        //Realizando a consulta na tabela de usuarios
        $query = "SELECT * FROM `tb_user` WHERE `email` = '".$email."' AND senha = '".$senha."'";
        $res = mysqli_query($conn,$query);//Executando a query

        $result = mysqli_fetch_assoc($res);//Buscando o resultado da pesquisa
        //var_dump($result);

        //Caso não encontre o usuário, ira retornar uma variavel $error = user
        if(!$result){
            header('location: index.php?error=user');
        }else{ //Caso encontre o usuário
            session_start();//Iniciando a sessão
            if($result['user_type'] == "admin"){//Verificando se o usuário e administrador
                //Irei passar na sessão o nome do usuário, para futuramente mostrar alguns dados para ele, caso necessario
                $_SESSION['admin'] = $result['nome'];
            }else if($result['user_type'] == "user"){//Se ele não for admin ele será usuário
                $_SESSION['user'] = $result['nome'];//Passando o nome do usuário atraves da sessao
            }  
        }

        //Parte responsavel pela auditoria

        //Mensagem que sera enviada para o arquivo
        $txt = "O usuário ".$result['nome']." realizou login no sistema as";
        escrever($txt,$GLOBALS['arquivo']);
        //Fim da parte responsavel pela auditoria

        mysqli_close($conn);
    }//Fim da função LOGIN

    //Função que exibe a lista de fornecedores/produtos
    function mostrar($conn,$table,$type){
        //Se o tipo for nulo, ela não será ordenada pelo parâmetro type
        if(!$type){
            if($table == "tb_user"){
                //Consulta ordenada pelo ID
                $query = "SELECT * FROM ".$table." ORDER BY id";
                $res = mysqli_query($conn,$query);

                echo '<table class="table">';
                echo "<thead>";
                echo "<tr>";

                    echo "<th>Nome</th>";
                    echo "<th>Tipo</th>";
                    echo "<th>E- mail</th>";
                    echo "<th>CNPJ</th>";
                    echo "<th>Telefone</th>";
                    echo "<th>ações</th>";

                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                while($resultado = mysqli_fetch_array($res)){
                    unset($resultado['senha']);
                    $id = $resultado['id'];
                    $nome = $resultado['nome'];
                    $email = $resultado['email'];
                    $cnpj = $resultado['cnpj'];
                    $telefone = $resultado['telefone'];
                    $user_type = $resultado['user_type'];
                    //Escrevendo os dados na tabela
                    echo "<tr>";
                        echo "<td>";
                            echo ucfirst($nome);
                        echo "</td>";

                        echo "<td>";
                            echo $user_type;
                        echo "</td>";

                        echo "<td>";
                            echo $email;
                        echo "</td>";

                        echo "<td>";
                            echo $cnpj;
                        echo "</td>";

                        echo "<td>";
                            echo $telefone;
                        echo "</td>";

                        echo "<td>";
                            include_once "botoes.php";
                            buttons($id);
                        echo "</td>";

                    echo "</tr>";
                }//Fim do while
            //Fim do (if $table == "tb_user")
            }else if($table == "tb_produtos"){//Consulta da tabela de produtos
                $query = "SELECT tb_produtos.id, tb_produtos.nome, tb_produtos.preco, tb_produtos.quantidade ,tb_user.nome AS 'fornecedor' FROM tb_produtos, tb_user WHERE tb_produtos.id_user = tb_user.id";
                $res = mysqli_query($conn,$query);
                echo '<table class="table">';
                echo "<thead>";
                echo "<tr>";
                    echo "<th>Produto</th>";
                    echo "<th>Preço</th>";
                    echo "<th>Quantidade</th>";
                    echo "<th>Fornecedor</th>";
                    echo "<th>ações</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($resultado = mysqli_fetch_array($res)){
                    //var_dump($resultado);
                    //inserindo nas variaveis os resultados das consultas
                    $id = $resultado['id'];
                    $nome = $resultado['nome'];
                    $preco = $resultado['preco'];
                    $quantidade = $resultado['quantidade'];
                    $fornecedor = $resultado['fornecedor'];

                    echo "<tr>";
                        echo "<td>";
                            echo ucfirst($nome);
                        echo "</td>";

                        echo "<td>";
                            echo $preco." R$";
                        echo "</td>";

                        echo "<td>";
                            echo $quantidade;
                        echo "</td>";

                        echo "<td>";
                            echo ucfirst($fornecedor);
                        echo "</td>";

                        echo "<td>";
                            include_once "botoes.php";
                            //Funcao para os botoes do produto
                            buttonsProd($id);
                        echo "</td>";

                    echo "<tr>";//Fim da tabela

                }//Fim do while
            }//Fim do else if($table == "tb_produtos")
            echo "</tbody>";
            echo "</table>";
        }
        //Encerrando a conexão
        mysqli_close($conn);   
    }//Fim da funcao de exibir a tabela de usuarios ou produtos

    // Função para cadastrar um usuário
    function createUser($conn,$nome,$email,$senha,$cnpj,$telefone,$user_type){
        //Verificando se o usuário digitou algum email existente
        if(!$user_type){
            $user_type = "user";
        }
        $query = "SELECT * FROM `tb_user` WHERE `email` LIKE '$email'";
        $resultado = mysqli_query($conn,$query);
        $res = mysqli_fetch_assoc($resultado);
        //var_dump($res);
        //Se encontrar algum usuário que tenha esse email, ele sera redirecionado para o cadastro
        if($res){
            header("location: cadastro.php?error=email");
        }else{
            //Inserindo os dados do usuario
            $query = "INSERT INTO `tb_user`";
            $query .= "VALUES (NULL, '".$nome."', '".$email."', '".$senha."', '".$cnpj."', '".$telefone."', '".$user_type."');";
            mysqli_query($conn,$query) or die("Erro ao tentar cadastrar registro\n");
            mysqli_close($conn);
            //echo "Cliente cadastrado com sucesso\n";
        }

        //Parte responsável pela auditoria
        $txt = "Um usuário : ".$nome." foi criado";
        escrever($txt,$GLOBALS['arquivo']);
        //Fim da parte responsavel pela auditoria

        header("location: ../index.php");
    }// FIM da funcao que cadastra o usuário


    //Função para deletar um usuário
    function deleteUser($conn, $id){
        //Consultando o nome do usuario para colocar na auditoria
        $consulta = "SELECT nome from tb_user WHERE tb_user.id = ".$id;
        $res = mysqli_query($conn,$consulta);
        $resposta = mysqli_fetch_array($res);

        //Para deletar um usuário, é preciso deletar todos os produtos que ele tem cadastrado
        $query = "DELETE FROM `tb_produtos` WHERE `tb_produtos`.`id_user` = $id";
        mysqli_query($conn,$query) or die("Erro na exclusão !!\n");
        $query = "DELETE FROM `tb_user` WHERE `tb_user`.`id` = $id";
        mysqli_query($conn,$query) or die("Erro na exclusão1 !!\n");

        mysqli_close($conn);
        header("location: ../admin.php?list=cli");
        
        //Parte da auditoria do sistema
        //Mensagem que sera passada na auditoria
        $txt = $_SESSION['admin']." excluiu o usuario: ".$resposta['nome'];
        escrever($txt,$GLOBALS['arquivo']);
        //Fim da parte da auditoria do sistema
        
    }//Fim da funcao de deletar um usuário

    //funcao para deletar um produto especifico
    function deleteProd($conn,$id){
        //Consultando o nome do produto antes de deletar
        $query = "SELECT nome FROM tb_produtos WHERE tb_produtos.id = ".$id;
        $res = mysqli_query($conn,$query);
        $resposta = mysqli_fetch_array($res);

        //Comando para deletar o produto
        $query = "DELETE FROM `tb_produtos` WHERE `tb_produtos`.`id` = $id";
        mysqli_query($conn,$query) or die ("Erro ao deletar");
        header("location: ../admin/admin.php?list=prod");
        mysqli_close($conn);

        //Parte da Auditoria

        //Precisa inicar a sessao para registar o nome do usuario
        session_start();
        //Se o usuário estiver setado como admin, será mostrado o nome dele
        if(isset($_SESSION['admin'])){
            $txt = $_SESSION['admin'];
        }else if(isset($_SESSION['user'])){//Se o usuario estiver user, será mostrado o nome dele
            $txt = $_SESSION['user'];
        }
        $txt .= " deletou o produto ".$resposta['nome'];
        escrever($txt,$GLOBALS['arquivo']);
        //Fim da parte da auditoria

    }//Fim do funcao para deletar um produto


    //Consultar um produto especifico
    function consultaProd($conn,$id){
        
        $query = "SELECT tb_produtos.id, tb_produtos.nome, tb_produtos.preco, tb_produtos.quantidade ,tb_user.id AS 'id_user',tb_user.nome AS 'fornecedor' FROM tb_produtos, tb_user WHERE tb_produtos.id_user = tb_user.id AND tb_produtos.id = $id";
        $res = mysqli_query($conn,$query) or die("Erro ao executar a consulta !!\n");
        $resultado = mysqli_fetch_array($res);
        //var_dump($resultado);
        // retorna um array com os resultados das buscas
        return $resultado;
        
    }//fim da funcao de consultar um produto especifico


    //Atualiza um produto
    //(conexao, valores do formulario)
    function updateProd($conn,$valor){
        echo "<pre>";
        var_dump($valor);
        echo "</pre>";
        
        $query = "UPDATE `tb_produtos` SET `nome` = '".$valor['nome']."', `preco` = '".$valor['preco']."',"; 
        $query .= "`quantidade` = '".$valor['quantidade']."',`id_user` = '".$valor['fornecedor']."' WHERE `tb_produtos`.`id` = '".$valor['id']."'";
        mysqli_query($conn,$query) or die ("Erro ao atualizar");
        mysqli_close($conn);

        //Parte responsavel pela auditoria

        //Iniciando a sessão
        session_start();
        if(isset($_SESSION['admin'])){//Se o usuario for um admin, sera mostrado o nome dele
            $txt = $_SESSION['admin'];
        }else if(isset($_SESSION['user'])){//Se o usuario estiver user, será mostrado o nome dele
            $txt = $_SESSION['user'];
        }

        $txt .= " Atualizou um produto as";
        escrever($txt,$GLOBALS['arquivo']);

        //Fim da parte da auditoria

    }//Fim da funcao de update


    //Funcao para criar um produto
    function createProd($conn, $valor){
        var_dump($valor);
        $query = "INSERT INTO `tb_produtos` (`id`, `nome`, `preco`, `quantidade`, `id_user`)";
        $query .= " VALUES (NULL, '".$valor['nome']."',  '".$valor['preco']."', '".$valor['quantidade']."',  '".$valor['fornecedor']."')";
        mysqli_query($conn,$query) or die("Erro ao cadastrar usuário\n");
        mysqli_close($conn);
        header("location: ../index.php?list=prod");

        //Parte da auditoria do sistema
        session_start();
        if(isset($_SESSION['admin'])){//Se o usuario for um admin, sera mostrado o nome dele
            $txt = $_SESSION['admin'];
        }else if(isset($_SESSION['user'])){//Se o usuario estiver user, será mostrado o nome dele
            $txt = $_SESSION['user'];
        }

        $txt .= " Criou um produto as";
        escrever($txt,$GLOBALS['arquivo']);
        //Fim da parte do sistema

    }//Fim da funcao que cria um produto

    //Funcao para atualizar um produto
    function updateUser($conn,$valor,$id){
        $query = "UPDATE tb_user SET nome = '".$valor['nome']."', email = '".$valor['email']."', cnpj = '".$valor['cnpj']."', ";
        $query .= "telefone = '".$valor['telefone']."', user_type = '".$valor['user_type']."' WHERE tb_user.id = $id";
        mysqli_query($conn,$query) or die ("Erro ao atualizar");
        mysqli_close($conn);

        //Parte da auditoria do sistema

        //Iniciando a sessão do usuário
        session_start();
        if(isset($_SESSION['admin'])){//Se o usuario for um admin, sera mostrado o nome dele
            $txt = $_SESSION['admin'];
        }else if(isset($_SESSION['user'])){//Se o usuario estiver user, será mostrado o nome dele
            $txt = $_SESSION['user'];
        }

        $txt .= " Atualizou um usuário as ->".$valor['nome'];
        escrever($txt,$GLOBALS['arquivo']);
        //Fim da parte do sistema

    }//Fim da funcao que atualiza um produto

    //funcao para pesquisar sobre um determinado usuário
    function consultaUser($conn,$id){
        $query = "SELECT * FROM tb_user WHERE id = $id";
        $res = mysqli_query($conn,$query);
        $resultado = mysqli_fetch_assoc($res);
        unset($resultado['senha']);
        return $resultado;
    }//Fim da funcao que faz a consulta de um determinado usuário

?>