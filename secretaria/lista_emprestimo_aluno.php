<?php
/* Controler ambiente da secretaria
 * Lista empréstimo em processo dos alunos
 * */
include_once '../classes/Emprestimo.php';
include_once '../classes/Aluno.php';
if($_POST){
    $pesquisa = Emprestimo::pesquisar($_POST['pesquisar']);

    $items = '';
    foreach ($pesquisa as $row) {
        $item = file_get_contents('../html/secretaria/item_emprestimo.html');
        $item = str_replace('{id}', $row['id_emprestimo'], $item);
        $item = str_replace('{nome}', $row['nome'], $item);
        $item = str_replace('{matricula}', $row['matricula'], $item);
        $item = str_replace('{cpf}', $row['cpf'], $item);
        $item = str_replace('{sobrenome}', $row['sobrenome'], $item);
        $items .= $item;
    }
    $list = file_get_contents('../html/secretaria/lista_emprestimo.html');
    $list = str_replace('{itens}', $items, $list);
    print $list;
}
else {
    $emprestimo = Emprestimo::all();

    $items = '';
    foreach ($emprestimo as $row) {
        $item = file_get_contents('../html/secretaria/item_emprestimo.html');
        $item = str_replace('{id}', $row['id_emprestimo'], $item);
        $item = str_replace('{nome}', $row['nome'], $item);
        $item = str_replace('{matricula}', $row['matricula'], $item);
        $item = str_replace('{cpf}', $row['cpf'], $item);
        $item = str_replace('{sobrenome}', $row['sobrenome'], $item);
        $items .= $item;
    }
    $list = file_get_contents('../html/secretaria/lista_emprestimo.html');
    $list = str_replace('{itens}', $items, $list);
    print $list;
}