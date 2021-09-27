<?php
/* Controler ambiente da secretaria
 * Editar registro de um bibliotecário
 * */

include_once '../classes/Bibliotecario.php';
include_once '../classes/Alert.php';

$pessoa = Bibliotecario::getBibliotecario($_REQUEST['id']);
$form = file_get_contents('../html/secretaria/editar_bibliotecario.html');
$form = str_replace('{id}', $pessoa['codigo_bibliotecario'], $form);
$form = str_replace('{nome}', $pessoa['nome'], $form);
$form = str_replace('{sobrenome}', $pessoa['sobrenome'], $form);
$form = str_replace('{cpf}', $pessoa['cpf'], $form);
$form = str_replace('{telefone}', $pessoa['telefone'], $form);
$form = str_replace('{email}', $pessoa['email'], $form);
$form = str_replace('{matricula}', $pessoa['matricula'], $form);
$form = str_replace('{endereco}', $pessoa['endereco'], $form);
print $form;