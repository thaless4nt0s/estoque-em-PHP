<?php
    /*
        Arquivo responsavel pela auditoria do sistema
        Será registrada qualquer ação, marcada pelo nome, horario,
        e o que a pessoa realizou
    */

    //Funcao para criar o arquivo

    function createFile(){
        //Atribuindo o dia/mes/ano para servir de nome para o arquivo
        date_default_timezone_set("America/Sao_Paulo");
        $data = date("dmY");
        $archive = fopen($data.".txt", "a+");
        if(!$archive){
            echo "Erro na criacao do arquivo !!!";
            return false;
        }
        //retornando o arquivo criado
        return $archive;
    }
    
    

    //Funcao para escrever os textos no arquivo
    function escrever($text, $archive){

        //Incluindo a Hora atual do sistema para concatenar com o final da frase
        $hora_atual = date("H:i:s");
        $text .= " ".$hora_atual."\n";

        //Comando para escrever no arquivo
        fwrite($archive, $text);
        //Fechano o arquivo
        fclose($archive);
    }
    //Funcao para mostrar os textos criados no arquivo
    function mostrarArquivo($archive){
        //Vai imprimindo linha por linha
        while(!feof($archive)){
            $linha = fgets($archive);
            echo $linha."<br>";
        }
        //Fechando o arquivo
        fclose($archive);
    }
    
    
?>