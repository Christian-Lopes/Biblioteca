<?php
include_once '../classes/Livro.php';
include_once '../classes/Tipo.php';
include_once '../classes/Categoria.php';

/* if (!empty($_REQUEST)) {
    try {
        if ($_POST) {
            $livro = $_POST;
            Livro::save($livro);
        }
    } catch (Exception $e) {
        print $e->getMessage();
    }
}*/

$form = file_get_contents('../html/bibliotecario/inserir_livro.html');
/*
$categorias = '';
foreach (Categoria::all() as $categoria) {
    $check = ($categoria['codigo_categoria'] == $categoria['categoria']) ? 'selected=1' : '';
    $categorias .= "<option $check value='{$categoria['codigo_categoria']}'>{$categoria['categoria']}</option>\n";
}
$form = str_replace('{categoria}', $categorias, $form);

$tipos = '';
foreach (Tipo::all() as $tipo) {
    $check = ($tipo['codigo_tipo'] == $tipo['tipo']) ? 'selected=1' : '';
    $tipos .= "<option $check value='{$tipo['codigo_tipo']}'>{$tipo['tipo']}</option>\n";
}

$form = str_replace('{tipo}', $tipos, $form); */
print $form;

