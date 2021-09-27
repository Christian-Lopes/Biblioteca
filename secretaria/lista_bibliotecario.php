<?php
/* Controler ambiente da secretaria
 * Listar funcionários da biblioteca
 * */
require_once '../classes/Bibliotecario.php';

if($_POST){
    $pesquisa = Bibliotecario::pesquisar($_POST['pesquisar']);

    $items = '';
    foreach ($pesquisa as $row) {
        $item = file_get_contents('../html/secretaria/bibliotecarios_itens.html');
        $item = str_replace('{codigo_bibliotecario}', $row['codigo_bibliotecario'], $item);
        $item = str_replace('{nome}', $row['nome'], $item);
        $item = str_replace('{sobrenome}', $row['sobrenome'], $item);
        $item = str_replace('{telefone}',Bibliotecario::formatTelefone($row['telefone']) , $item);
        $item = str_replace('{matricula}', $row['matricula'], $item);
        $items .= $item;
    }
    $list = file_get_contents('../html/secretaria/lista_bibliotecario.html');
    $list = str_replace('{itens}', $items, $list);
    print $list;
}
else {
    $pessoas = Bibliotecario::all();

    $items = '';
    foreach ($pessoas as $row) {
        $item = file_get_contents('../html/secretaria/bibliotecarios_itens.html');
        $item = str_replace('{codigo_bibliotecario}', $row['codigo_bibliotecario'], $item);
        $item = str_replace('{nome}', $row['nome'], $item);
        $item = str_replace('{sobrenome}', $row['sobrenome'], $item);
        $item = str_replace('{cpf}', $row['cpf'], $item);
        $item = str_replace('{matricula}', $row['matricula'], $item);
        $items .= $item;
    }
    $list = file_get_contents('../html/secretaria/lista_bibliotecario.html');
    $list = str_replace('{itens}', $items, $list);
    print $list;
}