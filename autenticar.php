
<?php
/*
 * Controlador queverifica cada usuário e senha para
 * direciona ao seu ambiente de usuário.
 * */
    require_once 'classes/Aluno.php';
    require_once 'classes/Secretaria.php';
    require_once 'classes/Bibliotecario.php';
    include_once 'classes/Funcionario.php';
    include_once 'classes/Emprestimo.php';
    include_once 'classes/EmprestimoFuncionario.php';
    include_once 'classes/Alert.php';
    session_start();

if(!empty($_POST)){
    $nome = $_POST['nome'];
    $pass = $_POST['senha'];
    $id_funcao = $_POST['id_funcao'];

    try{
        if($id_funcao) {
            if ($id_funcao == '5') {
                if (Secretaria::logar($nome, $pass)) {
                    header("location:secretaria/principal_secretaria.php?link=1");
                    Secretaria::logando();
                } else {
                    Alert::mensagem('Usuário Inválido!', 'login.php');
                }
            } elseif ($id_funcao == '6') {
                if (Bibliotecario::logar($nome, $pass)) {
                    header("location:bibliotecario/principal_bibliotecaria.php?link=1");
                    Bibliotecario::logando();
                } else {
                    Alert::mensagem('Usuário Inválido!', 'login.php');
                }
            } elseif ($id_funcao == '7') {
                if (Funcionario::logar($nome, $pass)) {
                    $all =EmprestimoFuncionario::buscaCPF($pass);
                    $id = $all['codigo_funcionario'];
                    $_SESSION['id'] = $id;
                    header("location:funcionario/principal_funcionario.php?link=1");
                    Funcionario::logando();
                } else {
                    Alert::mensagem('Usuário Inválido!', 'login.php');
                }
            } elseif ($id_funcao == '8') {
                if (Aluno::logar($nome, $pass)) {
                    $all = Emprestimo::buscaCPF($pass);
                    $id = $all['codigo_aluno'];
                    $_SESSION['id'] = $id;
                    header("location:aluno/principal_aluno.php?link=1");
                    Aluno::logando();
                } else {
                    Alert::mensagem('Usuário Inválido!', 'login.php');
                }
            }
        }
    }catch (Exception $e){
        print $e->getMessage();
    }
}