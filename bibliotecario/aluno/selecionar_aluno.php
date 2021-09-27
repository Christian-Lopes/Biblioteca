<?php
include_once '../classes/Aluno.php';
include_once '../classes/Curso.php';
include_once '../classes/Periodo.php';

$id = $_REQUEST;

$pessoa = Aluno::getAluno($id['id']);

$form = file_get_contents('../html/bibliotecario/selecionar_aluno.html');

$form = str_replace('{id}', $pessoa['codigo_aluno'], $form);
$form = str_replace('{nome}', $pessoa['nome'], $form);
$form = str_replace('{sobrenome}', $pessoa['sobrenome'], $form);
$form = str_replace('{cpf}', $pessoa['cpf'], $form);
$form = str_replace('{telefone}', $pessoa['telefone'], $form);
$form = str_replace('{email}', $pessoa['email'], $form);
$form = str_replace('{matricula}', $pessoa['matricula'], $form);
$form = str_replace('{endereco}', $pessoa['endereco'], $form);
$form = str_replace('{id_curso}', $pessoa['id_curso'], $form);
$form = str_replace('{id_periodo}', $pessoa['id_periodo'], $form);

$form = str_replace('{curso}', $pessoa['curso'], $form);
$form = str_replace('{periodo}', $pessoa['periodo'], $form);

print $form;

