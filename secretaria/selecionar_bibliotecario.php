<?php
/* Controler ambiente da secretaria
 * Registro do funcionário selecionado
 * */
require_once '../classes/Bibliotecario.php';

$pessoa = Bibliotecario::getBibliotecario($_REQUEST['id']);
    $item = file_get_contents('../html/secretaria/ficha_bibliotecario.html');
    $item = str_replace('{id}', $pessoa['codigo_bibliotecario'], $item);
    $item = str_replace('{nome}', $pessoa['nome'], $item);
    $item = str_replace('{sobrenome}', $pessoa['sobrenome'], $item);
    $item = str_replace('{matricula}', $pessoa['matricula'], $item);
    $item = str_replace('{cpf}', $pessoa['cpf'], $item);
    $item = str_replace('{telefone}', $pessoa['telefone'], $item);
    $item = str_replace('{endereco}', $pessoa['endereco'], $item);
    $item = str_replace('{email}', $pessoa['email'], $item);
print $item;