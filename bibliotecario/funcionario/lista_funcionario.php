
<?php
require_once '../classes/Funcionario.php';

$items = '';
foreach ($pessoas = Funcionario::all() as $row) {
    $item = file_get_contents('../html/bibliotecario/item_funcionario.html');
    $item = str_replace('{id}', $row['codigo_funcionario'], $item);
    $item = str_replace('{nome}', $row['nome'], $item);
    $item = str_replace('{telefone}', $row['telefone'], $item);
    $item = str_replace('{matricula}', $row['matricula'], $item);

    $items .= $item;
}

$list = file_get_contents('../html/bibliotecario/lista_funcionario.html');
$list = str_replace('{item}', $items, $list);
print $list;



