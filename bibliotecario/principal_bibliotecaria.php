<!doctype html>
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

include_once '../classes/Bibliotecario.php';
include_once '../classes/Alert.php';
if (filter_input(INPUT_GET, 'sair') == 'sim') {
    Bibliotecario::Deslogar();
    Alert::mensagem('Deseja sair?', '../login.php');
}
?>

<div class="wrapper">

    <div class="sidebar" data-image="../templates/assets/img/livros.jpg" data-color="blue">
        <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->

        <div class="sidebar-wrapper">

            <div class="logo">
                <h3>Área da Bibliotecária</h3>
            </div>

            <ul class="nav">

                <li><a href="?link=1"> Livros</a></li>
                <li><a href="?link=2"> Alunos</a></li>
                <li><a href="?link=3"> Funcionários</a></li>
                <li><a href="?link=4"> Cadastro de Livro</a></li>
                <li><a href="?link=5"> Cadastro de Aluno</a></li>
                <li><a href="?link=6"> Cadastro de Funcionário</a></li>

                <li><a href="?link=8"> Empréstimo Alunos</a></li>
                <li><a href="?link=7"> Empréstimo Funcionários</a></li>

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
                        <?php
                        $link = filter_input(INPUT_GET, 'link');
                        $pag[1] = 'livro/lista_livro.php';
                        $pag[2] = 'aluno/lista_aluno.php';
                        $pag[3] = 'funcionario/lista_funcionario.php';
                        $pag[4] = 'livro/inserir_livro.php';
                        $pag[5] = 'aluno/inserir_aluno.php';
                        $pag[6] = 'funcionario/inserir_funcionario.php';
                        $pag[7] = 'funcionario/lista_emprestimo_funcionario.php';
                        $pag[8] = 'aluno/lista_emprestimo_aluno.php';

                        $pag[9] = 'livro/excluir_livro.php';
                        $pag[10] = 'livro/editar_livro.php';
                        $pag[11] = 'aluno/excluir_aluno.php';
                        $pag[12] = 'aluno/editar_aluno.php';
                        $pag[13] = 'funcionario/excluir_funcionario.php';
                        $pag[14] = 'funcionario/editar_funcionario.php';

                        $pag[15] = 'livro/selecionar_livro.php';
                        $pag[16] = 'aluno/selecionar_aluno.php';
                        $pag[17] = 'funcionario/selecionar_funcionario.php';

                        $pag[18] = 'livro/emprestar_livro.php';
                        $pag[19] = 'livro/registro_empre_funcionario.php';
                        $pag[20] = 'livro/informar_emprestimo.php';

                        $pag[21] = 'livro/finalizar_emprestimo.php';
                        $pag[22] = 'aluno/registro_empre_aluno.php';
                        $pag[23] = 'aluno/finalizar_devolucao.php';

                        $pag[24] = 'funcionario/registro_emprestimo.php';
                        $pag[25] = 'funcionario/finalizar_devolucao.php';


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

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>

</body>
</html>