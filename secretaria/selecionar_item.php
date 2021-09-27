<?php
/* Controler ambiente da secretaria
 * Registro de empréstimo do aluno
 * */
require_once '../classes/Emprestimo.php';

$aluno = Emprestimo::find($_REQUEST['id']);
foreach ($aluno as $row) {
    $item = file_get_contents('../html/secretaria/ficha_aluno.html');
    $item = str_replace('{id}', $row['id_emprestimo'], $item);
    $item = str_replace('{nome}', $row['nome'], $item);
    $item = str_replace('{sobrenome}', $row['sobrenome'], $item);
    $item = str_replace('{matricula}', $row['matricula'], $item);
    $item = str_replace('{cpf}', $row['cpf'], $item);
    $item = str_replace('{telefone}', $row['telefone'], $item);
    $item = str_replace('{endereco}', $row['endereco'], $item);
    $item = str_replace('{email}', $row['email'], $item);
    $item = str_replace('{sobrenome}', $row['sobrenome'], $item);
    $item = str_replace('{curso}', $row['curso'], $item);
    $item = str_replace('{periodo}', $row['periodo'], $item);
    $item = str_replace('{titulo}', $row['titulo'], $item);
    $item = str_replace('{subtitulo}', $row['subtitulo'], $item);
    $item = str_replace('{quantidade}', $row['emprestimo'], $item);
}
print $item;