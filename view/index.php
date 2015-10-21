<?php
#iniciar_sessao
session_start();

#função para resolver problema de header
ob_start();

#define codificação
header('Content-Type: text/html; charset=UTF-8');

#cria o objeto de controle
$cg = new ControlGeral();
?>
<html lang="pt-br">
    <head>
        <!-- define a codificação do HTML -->
        <meta charset="utf-8">

        <!-- define a o titulo do HMTL -->
        <title>Sistema SGAVV</title>

        <!-- Link para o CSS do bootstrap -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Link para o CSS do bootstrap (menu) -->
        <link href="../bootstrap/css/navbar.css" rel="stylesheet">

    </head>
    <body>
        <!-- Link para o JQuery do bootstrap -->
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../bootstrap/js/ie10-viewport-bug-workaround.js"></script>

        <fieldset>
            <legend>Login</legend>
            <label>Senha</label>
            <input type="text" name="login">
            <br>
            <label>Senha</label>
            <input type="password" name="login">
            <br>
            <input type="submit" name="acessar" value="Acesar">
            | <a href="modulo.php?modulo=anunciante&menu=cadastrar">Cadastra-se</a>
        </fieldset>

    </body>
</html>
