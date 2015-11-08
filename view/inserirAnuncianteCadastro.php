<?php
#iniciar_sessao
#session_start();

#função para resolver problema de header
ob_start();

#define codificação
header('Content-Type: text/html; charset=UTF-8');

#carrega as classes automaticamente
include_once 'autoload.php';


#cria o objeto de controle
$objCA = new ControlAnunciante();

#verfica o o botão 'Inserir' foi acionado
if (isset($_POST["inserir"])) {
    #passa os dados para inserir
    $objCA->inserirCadastro($_POST['nome'], $_POST['endereco'], $_POST['telefone'], $_POST['email'], $_POST['senha'], $_POST['confirmar']);
}
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

        <div class="container">
            <!-- inserir o menu -->
            <?php
            #mostrar o menu
            $objCA->alerta($_SESSION['msg']);
            ?> 

            <!-- Main component for a primary marketing message or call to action -->
            <div class="jumbotron">
                <fieldset>
                    <legend>Dados do Anunciante</legend>
                    <form method="post">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input class="form-control" required type="text" name="nome" id="nome" />
                            <label for="endereco">Endereco</label>
                            <input class="form-control" required id="endereco" name="endereco" type="text" title="Qual seu endereço?">
                            <label for="telefone">Telefone</label>
                            <input class="form-control" required id="telefone" name="telefone" type="text" maxlength="14">
                            <label for="email">E-mail</label>
                            <input class="form-control" id="email" name="email" type="email">
                            <label for="senha">Senha</label>
                            <input class="form-control" id="senha" name="senha" type="password">
                            <label for="confirmar">Confirmar Senha</label>
                            <input class="form-control" id="confirmar" name="confirmar" type="password">
                            </br>
                            <button type="submit" name="inserir" class="btn btn-primary" style="width: 100%;"><span class="glyphicon bg-success"></span>Inserir</button>
                        </div>
                    </form>
                </fieldset> 
            </div>


    </body>
</html>



</body>
</html>
