<?php
require_once '../classes/Livro.php';
require_once '../classes/Tipo.php';
require_once '../classes/Categoria.php';
try {

    $livros = Livro::all();

} catch (Exception $e) {
    print $e->getMessage();
}


$items = '';
foreach ($livros  as $row) {
    $item = file_get_contents('../html/bibliotecario/item_livro.html');
    $item = str_replace('{id}', $row['codigo_livro'], $item);
    $item = str_replace('{titulo}', $row['titulo'], $item);
    $item = str_replace('{editora}', $row['editora'], $item);
    $item = str_replace('{quantidade}', $row['quantidade'], $item);

    $items .= $item;
}

$list = file_get_contents('../html/bibliotecario/lista_livro.html');
$list = str_replace('{item}', $items, $list);
print $list;


