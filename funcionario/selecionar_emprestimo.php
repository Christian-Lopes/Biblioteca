<?php

include_once '../classes/EmprestimoFuncionario.php';

$id = $_REQUEST['id'];
$registro = EmprestimoFuncionario::find($id);
//var_dump($registro);
$data = EmprestimoFuncionario::dataFormatada($_REQUEST['id']);
$data_entrega = EmprestimoFuncionario::dataEntrega($data);
$atraso = EmprestimoFuncionario::diaAtraso($data_entrega);
$multa = EmprestimoFuncionario::multa($_REQUEST['id'], $atraso);

foreach ($registro as $row) {
    $item = file_get_contents('../html/funcionario/selecionar_emprestimo.html');

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
    $item = str_replace('{data_emprestimo}', $data, $item);
    $item = str_replace('{data_devolucao}', $data_entrega, $item);
    $item = str_replace('{atraso}', $atraso, $item);
    $item = str_replace('{multa}', $multa, $item);

}

print $item;
