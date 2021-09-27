<?php
require_once '../classes/Aluno.php';

try {
    $pessoas = Aluno::all();

} catch (Exception $e) {
    print $e->getMessage();
}

$items = '';
foreach ($pessoas = Aluno::all() as $row) {
    $item = file_get_contents('../html/bibliotecario/item_aluno.html');
    $item = str_replace('{id}', $row['codigo_aluno'], $item);
    $item = str_replace('{nome}', $row['nome'], $item);
    $item = str_replace('{telefone}', $row['cpf'], $item);
    $item = str_replace('{matricula}', $row['matricula'], $item);

    $items .= $item;
}

$list = file_get_contents('../html/bibliotecario/lista_aluno.html');
$list = str_replace('{item}', $items, $list);
print $list;


