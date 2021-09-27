<?php
/* Controler ambiente da secretaria
 * Registro de empréstimo do funcionário
 * */
require_once '../classes/EmprestimoFuncionario.php';

$funcionario = EmprestimoFuncionario::find($_REQUEST['id']);
foreach ($funcionario as $row) {
    $item = file_get_contents('../html/secretaria/ficha_funcionario.html');
    $item = str_replace('{id}', $row['cod_emprestimo'], $item);
    $item = str_replace('{nome}', $row['nome'], $item);
    $item = str_replace('{sobrenome}', $row['sobrenome'], $item);
    $item = str_replace('{matricula}', $row['matricula'], $item);
    $item = str_replace('{cpf}', $row['cpf'], $item);
    $item = str_replace('{telefone}', $row['telefone'], $item);
    $item = str_replace('{endereco}', $row['endereco'], $item);
    $item = str_replace('{email}', $row['email'], $item);
    $item = str_replace('{sobrenome}', $row['sobrenome'], $item);
    $item = str_replace('{funcao}', $row['funcao'], $item);
    $item = str_replace('{titulo}', $row['titulo'], $item);
    $item = str_replace('{subtitulo}', $row['subtitulo'], $item);
    $item = str_replace('{quantidade}', $row['emprestimo'], $item);
}
print $item;