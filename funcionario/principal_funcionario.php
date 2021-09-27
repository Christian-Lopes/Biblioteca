<!doctype html>
<!--Template principal do ambiente dos funcionários-->
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="../templates/assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Biblioteca Online</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta name="viewport" content="width=device-width"/>
    <link href="../templates/assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../templates/assets/css/animate.min.css" rel="stylesheet"/>
    <link href="../templates/assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
    <link href="../templates/assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script src="../templates/assets/js/Chart.bundle.min.js"></script>
    <script src="../templates/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="../templates/assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../templates/assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

</head>
<body>
<?php
session_start();

include_once '../classes/Funcionario.php';
if (filter_input(INPUT_GET, 'sair') == 'sim') {
    Funcionario::Deslogar();
}
?>

<div class="wrapper">
    <div class="sidebar" data-image="../templates/assets/img/livros.jpg" data-color="blue">
        <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->
        <div class="sidebar-wrapper">
            <div class="logo">
                <h3>Área do Funcionário</h3>
            </div>
            <ul class="nav">
                <li><a href="?link=1"> Lista de Livros</a></li>
                <li><a href="?link=2"> Emprestimo</a></li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <!-- botao que mostra e esconde a navbar-->
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div><!--fim header navbar-->
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="?sair=sim" onclick="return confirm('Deseja sair do sistema?')">
                                <p>Log out</p>
                            </a>
                        </li>
                        <li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <?php
                            $link = filter_input(INPUT_GET, 'link');
                            $pag[1] = 'lista_livro.php';
                            $pag[2] = 'emprestimo.php';

                            $pag[6] = 'selecionar_livro.php';
                            $pag[7] = 'selecionar_emprestimo.php';

                            if (file_exists($pag[$link])) {
                                include_once $pag[$link];
                            } else {
                                print "Página não foi encontrada<hr>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>

</body>
</html>