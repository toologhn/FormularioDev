<?php
require "config.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="formulario1.css" media="screen">
    <title>Cadastro</title>
</head>
<body>
    <div class="campo">
        <h1 id="titulo">Cadastro de DEVs</h1>
        <br>
        <p id="subtitulo">Insira suas informações</p>
        
    </div>   

    <form method="post" action="">
        <fieldset class="grupo">
            <div class="campo">
                <strong><label for="nome">Nome</label></strong>
                <input type="text" name="nome" id="nome" required>
            </div>

            <div class="campo">
                <label for="sobrenome"><strong>Sobrenome</strong></label>
                <input type="text" name="sobrenome" id="sobrenome" required>
            </div>

        </fieldset>
        <div class="campo">
            <label for="email"><strong>Email</strong></label>
            <input type="email" name="email" id="email">
        </div>

        <div class="campo">
            <strong><label>Qual parte da aplicação você desenvolve?</label></strong>
            <label>
                <input type="radio" name="devweb" value="Front-end">Front-end
            </label>
            <label>
                <input type="radio" name="devweb" value="Back-end">Back-end
            </label>
            <label>
                <input type="radio" name="devweb" value="Fulltack">Fulltack
            </label>
            </div>

        <div class="campo">
            <strong><label for="senioridade">Senioridade</label></strong>
            <select name="senioridade" id="Senioridade" required>
                <option selected disabled value="">Selecione</option>
                <option>Junior</option>
                <option>pleno</option>
                <option>Senior</option>
            </select>
        </div>    
        
        <fieldset class="grupo">
            <div id="check">
                <strong><label>Selecione as tecnologias: </label></strong>
                <input type="checkbox" id="tecnologia1" name="tecnologia[]" value="HTML">
                <label for="tencnologia1">HTML</label>
                <input type="checkbox" id="tecnologia2" name="tecnologia[]" value="CSS">
                <label for="tecnologia2">CSS</label>
                <input type="checkbox" id="tecnologia3" name="tecnologia[]" value="Javascript">
                <label for="tecnologia3">Javascript</label>
                <input type="checkbox" id="tecnologia4" name="tecnologia[]" value="PHP">
                <label for="tecnologia4">PHP</label>       
               </div>
        </fieldset>

        <div class="campo">
            <br>
            <b><label>Nos conte sua historia</label></b>
            <textarea rows="6" style="width: 26em" id="experiencia" name="experiencia"></textarea>
        </div>

        <button class="botao" name="enviado" type="submit">Concluido</button>

    </form>
    <?php
    if(isset($_POST['enviado'])) {
        try{
            $tecnologia = implode(", ", $_POST['tecnologia']);
            $candidatos = $mysql -> prepare("INSERT INTO candidatos (ID, Nome, Sobrenome, Email, Aplicacao, Senioridade, Tecnologias, Experiencia) VALUES (NULL, :nome, :sobrenome, :email, :aplicacao, :senioridade, :tecnologia, :experiencia);");
            $candidatos -> bindValue(":nome",$_POST['nome'],PDO::PARAM_STR);
            $candidatos -> bindValue(":sobrenome",$_POST['sobrenome'],PDO::PARAM_STR);
            $candidatos -> bindValue(":email",$_POST['email'],PDO::PARAM_STR);
            $candidatos -> bindValue(":aplicacao",$_POST['devweb'],PDO::PARAM_STR);
            $candidatos -> bindValue(":senioridade",$_POST['senioridade'],PDO::PARAM_STR);
            $candidatos -> bindValue(":tecnologia",$tecnologia,PDO::PARAM_STR);
            $candidatos -> bindValue(":experiencia",$_POST['experiencia'],PDO::PARAM_STR);
            if ($candidatos -> execute()){
            $nome = ucwords(strtolower($_POST['nome']));
            echo "{$nome}, obrigado por se cadastrar no nosso site, aguarde o retorno no Email: {$_POST['email']}.";

            }
        }catch(PDOException $ERRO) {
            echo $ERRO -> getMessage();

            }
        }
    ?>
</body>
</html>