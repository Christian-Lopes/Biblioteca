
<?php

include_once '../classes/Funcionario.php';
include_once '../classes/Funcao.php';

$pessoa = Funcionario::getFuncionario($_REQUEST['codigo_funcionario']);

$form = file_get_contents('../html/bibliotecario/editar_funcionario.html');

$form = str_replace('{id}', $pessoa['codigo_funcionario'], $form);
$form = str_replace('{nome}', $pessoa['nome'], $form);
$form = str_replace('{sobrenome}', $pessoa['sobrenome'], $form);
$form = str_replace('{cpf}', $pessoa['cpf'], $form);
$form = str_replace('{telefone}', $pessoa['telefone'], $form);
$form = str_replace('{email}', $pessoa['email'], $form);
$form = str_replace('{matricula}', $pessoa['matricula'], $form);
$form = str_replace('{endereco}', $pessoa['endereco'], $form);
$form = str_replace('{id_funcao}', $pessoa['id_funcao'], $form);

$funcoes = '';
foreach (Funcao::all() as $row) {
    $check = ($row['codigo_funcao'] == $pessoa['id_funcao']) ? 'selected=1' : '';
    $funcoes .= "<option $check value='{$row['codigo_funcao']}'>{$row['funcao']}</option>\n";
}
$form = str_replace('{funcao}', $funcoes, $form);

print $form;



