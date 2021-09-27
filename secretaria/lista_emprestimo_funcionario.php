<?php
/* Controler ambiente da secretaria
 * Lista empréstimo em processo dos funcionários
 * */
include_once '../classes/EmprestimoFuncionario.php';

if($_POST){
    $pesquisar = EmprestimoFuncionario::pesquisar($_POST['pesquisar']);

    $items = '';
    foreach ($pesquisar as $row) {
        $item = file_get_contents('../html/secretaria/item_emprestimo_funcionario.html');
        $item = str_replace('{id}', $row['cod_emprestimo'], $item);
        $item = str_replace('{nome}', $row['nome'], $item);
        $item = str_replace('{sobrenome}', $row['sobrenome'], $item);
        $item = str_replace('{matricula}', $row['matricula'], $item);
        $item = str_replace('{cpf}', $row['cpf'], $item);
        $items .= $item;
    }
    $list = file_get_contents('../html/secretaria/lista_emprestimo_funcionario.html');
    $list = str_replace('{itens}', $items, $list);
    print $list;
}
else {
    $emprestimo = EmprestimoFuncionario::all();

    $items = '';
    foreach ($emprestimo as $row) {
        $item = file_get_contents('../html/secretaria/item_emprestimo_funcionario.html');
        $item = str_replace('{id}', $row['cod_emprestimo'], $item);
        $item = str_replace('{nome}', $row['nome'], $item);
        $item = str_replace('{sobrenome}', $row['sobrenome'], $item);
        $item = str_replace('{matricula}', $row['matricula'], $item);
        $item = str_replace('{cpf}', $row['cpf'], $item);
        $items .= $item;
    }
    $list = file_get_contents('../html/secretaria/lista_emprestimo_funcionario.html');
    $list = str_replace('{itens}', $items, $list);
    print $list;
}