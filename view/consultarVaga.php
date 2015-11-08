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
$cg = new ControlGeral();
#validar sessao
$cg->validarSessao();

$objCV = new ControlVaga();
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

            <?php
            #mostrar o menu
            $objCV->menu();
            $objCV->alerta($_SESSION['msg']);
            ?> 

            <!-- Main component for a primary marketing message or call to action -->
            <div class="jumbotron">
                <fieldset>
                    <legend>Consultar Anuncio</legend>
                    <form method="post">
                        <div class="form-group">
                            <label for="uf">UF</label>
                            <input class="form-control" required type="text" name="uf" id="uf" />
                            <label for="cidade">Cidade</label>
                            <input class="form-control" required id="cidade" name="cidade" type="text">
                            <label for="vagaspara">Vagas Para</label>
                            <input class="form-control" id="vagaspara" name="vagaspara" type="text">
                            <label for="tipo">Tipo</label>
                            <input class="form-control" id="tipo" name="tipo" type="text">
                            </br>
                            <button type="submit" name="cadastrar" class="btn btn-primary" style="width: 100%;"><span class="glyphicon bg-success"></span>Consultar</button>
                        </div>
                    </form>
                </fieldset> 
            </div>
    </body>
</html>
