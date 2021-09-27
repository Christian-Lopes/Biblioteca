<?php

include_once '../classes/Livro.php';
include_once '../classes/Tipo.php';
include_once '../classes/Categoria.php';

$livro = Livro::getLivro($_REQUEST['id']);

$form = file_get_contents('../html/bibliotecario/editar_livro.html');

$form = str_replace('{id}', $livro['codigo_livro'], $form);
$form = str_replace('{titulo}', $livro['titulo'], $form);
$form = str_replace('{subtitulo}', $livro['subtitulo'], $form);
$form = str_replace('{editora}', $livro['editora'], $form);
$form = str_replace('{publicado}', $livro['publicado'], $form);
$form = str_replace('{isbn}', $livro['isbn'], $form);
$form = str_replace('{quantidade}', $livro['quantidade'], $form);
$form = str_replace('{edicao}', $livro['edicao'], $form);
$form = str_replace('{autor}', $livro['autor'], $form);
$form = str_replace('{id_categoria}', $livro['id_categoria'], $form);
$form = str_replace('{id_tipo}', $livro['id_tipo'], $form);

$categorias = '';
foreach (Categoria::all() as $row) {
    $check = ($row['codigo_categoria'] == $livro['id_categoria']) ? 'selected=1' : '';
    $categorias .= "<option $check value='{$row['codigo_categoria']}'>{$row['categoria']}</option>\n";
}
$form = str_replace('{categoria}', $categorias, $form);

$tipos = '';
foreach (Tipo::all() as $row) {
    $check = ($row['codigo_tipo'] == $livro['id_tipo']) ? 'selected=1' : '';
    $tipos .= "<option $check value='{$row['codigo_tipo']}'>{$row['tipo']}</option>\n";
}

$form = str_replace('{tipo}', $tipos, $form);
print $form;


