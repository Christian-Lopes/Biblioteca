
<?php

include_once '../classes/Emprestimo.php';

$alunos = Emprestimo::find($_REQUEST['id']);

$data = Emprestimo::dataFormatada($_REQUEST['id']);
$data_entrega = Emprestimo::dataEntrega($data);
$atraso = Emprestimo::diaAtraso($data_entrega);
$multa = Emprestimo::multa($_REQUEST['id'], $atraso);

foreach ($alunos as $aluno) {
    $item = file_get_contents('../html/bibliotecario/registro_empre_aluno.html');

    $item = str_replace('{id}', $aluno['id_emprestimo'], $item);
    $item = str_replace('{nome}', $aluno['nome'], $item);
    $item = str_replace('{sobrenome}', $aluno['sobrenome'], $item);
    $item = str_replace('{matricula}', $aluno['matricula'], $item);
    $item = str_replace('{cpf}', $aluno['cpf'], $item);
    $item = str_replace('{telefone}', $aluno['telefone'], $item);
    $item = str_replace('{endereco}', $aluno['endereco'], $item);
    $item = str_replace('{email}', $aluno['email'], $item);
    $item = str_replace('{sobrenome}', $aluno['sobrenome'], $item);
    $item = str_replace('{curso}', $aluno['curso'], $item);
    $item = str_replace('{periodo}', $aluno['periodo'], $item);
    $item = str_replace('{titulo}', $aluno['titulo'], $item);
    $item = str_replace('{subtitulo}', $aluno['subtitulo'], $item);
    $item = str_replace('{quantidade}', $aluno['emprestimo'], $item);
    $item = str_replace('{data_emprestimo}',$data, $item);
    $item = str_replace('{data_devolucao}', $data_entrega, $item);
    $item = str_replace('{atraso}', $atraso, $item);
    $item = str_replace('{multa}',$multa, $item);

}

print $item;
