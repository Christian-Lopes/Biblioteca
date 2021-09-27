<?php
/* Controler ambiente do funcionário
 * Lista todos os livros da biblioteca
 * */
require_once '../classes/Livro.php';
require_once '../classes/Tipo.php';
require_once '../classes/Categoria.php';

if($_POST) {
    $livros = Livro::pesquisaLivro($_POST['pesquisar']);
    $items = '';
    foreach ($livros as $row) {
        $item = file_get_contents('../html/funcionario/item_livro.html');
        $item = str_replace('{id}', $row['codigo_livro'], $item);
        $item = str_replace('{titulo}', $row['titulo'], $item);
        $item = str_replace('{categoria}', $row['categoria'], $item);
        $item = str_replace('{quantidade}', $row['quantidade'], $item);
        $items .= $item;
    }
    $list = file_get_contents('../html/funcionario/lista_livro.html');
    $list = str_replace('{item}', $items, $list);
    print $list;
}else{
    $livros = Livro::all();
    $items = '';
    foreach ($livros as $row) {
        $item = file_get_contents('../html/funcionario/item_livro.html');
        $item = str_replace('{id}', $row['codigo_livro'], $item);
        $item = str_replace('{titulo}', $row['titulo'], $item);
        $item = str_replace('{categoria}', $row['categoria'], $item);
        $item = str_replace('{quantidade}', $row['quantidade'], $item);
        $items .= $item;
    }
    $list = file_get_contents('../html/funcionario/lista_livro.html');
    $list = str_replace('{item}', $items, $list);
    print $list;
}