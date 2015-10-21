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
if (isset($_POST["consultar"])) {
    #passa os dados para inserir
    $anunciantes = $objCA->consultarAnunciantes($_POST['nome'],$_POST['telefone'], $_POST['email']);
    } else {
    #mostrar todos os funcionarios
    $anunciantes = $objCA->consultarAnunciantes(null, null, null);
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
            $objCA->menu();
            $objCA->alerta($_SESSION['msg']);
            ?> 

            <!-- Main component for a primary marketing message or call to action -->
            <div class="jumbotron">
                <fieldset>
                    <legend>Consultar Anunciante</legend>
                    <form method="post">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input class="form-control"  type="text" name="nome" id="nome" />
                            <label for="telefone">Telefone</label>
                            <input class="form-control"  id="telefone" name="telefone" type="text" maxlength="14">
                            <label for="email">E-mail</label>
                            <input class="form-control" id="email" name="email" type="email">
                            </br>
                            <button type="submit" name="consultar" class="btn btn-primary" style="width: 100%;"><span class="glyphicon bg-success"></span>consultar</button>
                        </div>
                    </form>
                </fieldset> 
            </div>


            <div class="jumbotron">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="mytable" class="table table-bordred table-striped">
                                    <thead>
                                    <th>Codigo</th>
                                    <th>Nome</th>
                                    <th>Endereco</th>
                                    <th>Telefone</th>
                                    <th>E-mail</th>
                                    <th>Alterar</th>
                                    <th>Excluir</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        #foreach para listar os dados do cliente
                                        foreach ($anunciantes as $item) {
                                            echo "<tr>";
                                            echo "<td> {$item[id_anunciante]} </td>";
                                            echo "<td> {$item[nome]} </td>";
                                            echo "<td> {$item[endereco]} </td>";
                                            echo "<td> {$item[telefone]} </td>";
                                            echo "<td> {$item[email]} </td>";
                                            echo "<td><p data-placement='top' data-toggle='tooltip' title='Alterar'><button class='btn btn-primary btn-xs' data-title='Alterar' data-toggle='modal' data-target='#alterar{$item[id_anunciante]}'><span class='glyphicon glyphicon-pencil'></span></button></p></td>";
                                            echo "<td><p data-placement='top' data-toggle='tooltip' title='Excluir'><button class='btn btn-danger btn-xs' data-title='Delete' data-toggle='modal' data-target='#excluir{$item[id_anunciante]}'><span class='glyphicon glyphicon-trash'></span></button></p></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>                         
                            </div>

                        </div>
                    </div>
                </div>
            </div>



            <?php
            #foreach para listar os dados do cliente e definica cada modal para alterar
            foreach ($objCA as $item) {
                ?>
                <!-- modal de alterar -->
                <div class="modal fade" id="alterar<?php echo $item[id] ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                <h4 class="modal-title custom_align" id="Heading">Alterar Anunciante</h4>
                            </div>
                            <div class="modal-body">

                                <?php
                                #inclui a view alterar cliente
                                #include 'alterarAnunciante.php';
                                ?>       

                            </div>
                        </div>
                    </div>
                </div> 
                <?php
            }
            ?>

            <?php
            #foreach para listar os dados do cliente e definica cada modal para alterar
            foreach ($objCA as $item) {
                ?>
                <!-- modal de exluir -->
                <div class="modal fade" id="excluir<?php echo $item[id] ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                <h4 class="modal-title custom_align" id="Heading">Excluir Anunciante</h4>
                            </div>
                            <div class="modal-body">

                                <?php
                                #inclui a view alterar cliente
                                # include 'excluirAnunciante.php';
                                ?>       

                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?> 



            <!-- Script -->
            <script>
                $(document).ready(function () {
                    $("#mytable #checkall").click(function () {
                        if ($("#mytable #checkall").is(':checked')) {
                            $("#mytable input[type=checkbox]").each(function () {
                                $(this).prop("checked", true);
                            });

                        } else {
                            $("#mytable input[type=checkbox]").each(function () {
                                $(this).prop("checked", false);
                            });
                        }
                    });

                    $("[data-toggle=tooltip]").tooltip();
                });
            </script>

    </body>
</html>



</body>
</html>
