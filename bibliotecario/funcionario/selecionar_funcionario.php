<?php
include_once '../classes/Funcionario.php';

$id = $_REQUEST;

$pessoa = Funcionario::getFuncionario($id['codigo_funcionario']);

$form = file_get_contents('../html/bibliotecario/selecionar_funcionario.html');

$form = str_replace('{id}', $pessoa['codigo_funcionario'], $form);
$form = str_replace('{nome}', $pessoa['nome'], $form);
$form = str_replace('{sobrenome}', $pessoa['sobrenome'], $form);
$form = str_replace('{cpf}', $pessoa['cpf'], $form);
$form = str_replace('{telefone}', $pessoa['telefone'], $form);
$form = str_replace('{email}', $pessoa['email'], $form);
$form = str_replace('{matricula}', $pessoa['matricula'], $form);
$form = str_replace('{endereco}', $pessoa['endereco'], $form);
$form = str_replace('{funcao}', $pessoa['funcao'], $form);


print $form;