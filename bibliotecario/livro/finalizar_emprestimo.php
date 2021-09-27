<?php
/*
 * Código responsável por verificar tipo de usuários, cpf,
 * quantidade de livros disponível e a quantidade disponível para os usuários.
 * */
include_once '../classes/Emprestimo.php';
include_once '../classes/EmprestimoFuncionario.php';
include_once  '../classes/Alert.php';
//var_dump($_REQUEST);
$numero = $_REQUEST['quantidade'];
$quantidade = (int) $_REQUEST['quantidade'];
$disponivel = (int) $_REQUEST['disponivel'];
$id_livro = $_REQUEST['codigo_livro'];
$livro = $_REQUEST['codigo_livro'];
$leitor = $_REQUEST['leitor'];
$cpf = $_REQUEST['cpf'];
$result = $disponivel - $quantidade;

//Verifica se a quantidade de livro solicitado se não utrapassa a quantidade disponível
if($result >= 0){

   //Verifica o usúario(aluno, ou funciónario)
    if($leitor == '1'){
        //Valida se o cpf do aluno está no banco
        if($alunos = Emprestimo::buscaCPF($cpf)) {
            $emprestimo = Emprestimo::registroEmprestimo($alunos['codigo_aluno']);

            $total = 0;
            foreach ($emprestimo as $row) {
                $numero = (int)$row['emprestimo'];
                $total = $total + $numero;
            }
            //Verificar se o aluno tem número de emprestimo no limite
            $total = $total + $quantidade;
            if($total <= 3){

                echo '<br> Pode faser o emprestimo';
                try {
                    $date = new DateTime();

                    $dados = array(
                        'data_emprestimo' => $date->format('Y-m-d'),
                        'emprestimo' => $numero,
                        'id_aluno' => $alunos['codigo_aluno'],
                        'id_livro' => $livro
                    );

                    Emprestimo::save($dados);

                    //Emprestimo realizado volta para lista de livros
                    Alert::mensagem('Empréstimo realizado com sucesso!','principal_bibliotecaria.php?link=1' );
                }catch (Exception $e){
                    print $e->getMessage();
                }


            }else{
                //Caso o numero de livros utrapasse a quantidade limite de livros emprestado********//informar_emprestimo.php
                Alert::mensagem('Limite de empréstimo atingido!','principal_bibliotecaria.php?link=1' );
            }

        }else{
            //Caso o cpf não conste no banco de dados
            Alert::mensagem('CPF inválido!','principal_bibliotecaria.php?link=1' );
        }



        //Área para verificar Funcionário
    }elseif ($leitor == '2'){
        echo 'Funcionario';
        //Valida se o cpf do aluno está no banco
        if($funcionario = EmprestimoFuncionario::buscaCPF($cpf)) {
            $emprestimo = EmprestimoFuncionario::registroEmprestimo($funcionario['codigo_funcionario']);
            //var_dump($funcionario);
            //var_dump($emprestimo);
            $total = 0;
            foreach ($emprestimo as $row) {
                $numero = (int)$row['emprestimo'];
                $total = $total + $numero;
            }
            //Verificar se o aluno tem número de emprestimo no limite
            $total = $total + $quantidade;
            if($total <= 3){
                echo '<br> Pode faser o emprestimo';
                try {
                    $date = new DateTime();

                    $dados = array(
                        'data_emprestimo' => $date->format('Y-m-d'),
                        'emprestimo' => $numero,
                        'id_funcionario' => $funcionario['codigo_funcionario'],
                        'id_livro' => $livro,

                    );


                    EmprestimoFuncionario::save($dados);
                    //Emprestimo realizado volta para lista de livros
                    Alert::mensagem('Empréstimo realizado com sucesso!','principal_bibliotecaria.php?link=1' );
                }catch (Exception $e){
                    print $e->getMessage();
                }


            }else{
                //Caso o limite do empréstimo do funcionário esteja no limite
                Alert::mensagem('Está no limite do empréstim!','principal_bibliotecaria.php?link=1' );
            }

        }else{

            //Caso o cpf não conste no banco de dados
            Alert::mensagem('CPF inválido!','principal_bibliotecaria.php?link=1' );
        }

    }else{
        //Caso usuário não bata com funcionário ou alunos*******//informar_emprestimo.php
        Alert::mensagem('Usuário inválido!','principal_bibliotecaria.php?link=1' );

    }

}else{
    //Quantidade solicitada do livro é indisponivel  e retorna para lista de livro
    Alert::mensagem('Quantidade solicitada do livro é indisponivel!','principal_bibliotecaria.php?link=1' );

}




