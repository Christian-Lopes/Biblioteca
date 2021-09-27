<?php

include_once '../classes/EmprestimoFuncionario.php';
include_once '../classes/Emprestimo.php';
include_once '../classes/Funcionario.php';

$emprestimo = EmprestimoFuncionario::emprestimoDeFuncionario($_SESSION['id']);

$items = '';
foreach ($emprestimo as $row) {
    $item = file_get_contents('../html/funcionario/item_emprestimo.html');
    $item = str_replace('{id}', $row['cod_emprestimo'], $item);
    $item = str_replace('{titulo}', $row['titulo'], $item);
    $item = str_replace('{data_emprestimo}', EmprestimoFuncionario::dataFormatada($row['cod_emprestimo']), $item);
    $item = str_replace('{devolucao}', EmprestimoFuncionario::dataEntrega($row['data_emprestimo']), $item);

    $items .= $item;
}
$list = file_get_contents('../html/funcionario/lista_emprestimo.html');
$list = str_replace('{itens}', $items, $list);
print $list;