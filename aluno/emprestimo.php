<?php

/* Controler ambiente da secretaria
 * Lista empréstimo em processo dos alunos
 * */
include_once '../classes/Emprestimo.php';
include_once '../classes/Aluno.php';

    $emprestimo = Emprestimo::emprestimoAluno($_SESSION['id']);

    $items = '';
    foreach ($emprestimo as $row) {
        $item = file_get_contents('../html/aluno/item_emprestimo.html');
        $item = str_replace('{id}', $row['id_emprestimo'], $item);
        $item = str_replace('{titulo}', $row['titulo'], $item);
        $item = str_replace('{data_emprestimo}', Emprestimo::dataFormatada($row['id_emprestimo']), $item);
        $item = str_replace('{devolucao}', Emprestimo::dataEntrega($row['data_emprestimo']), $item);

        $items .= $item;
    }
    $list = file_get_contents('../html/aluno/lista_emprestimo.html');
    $list = str_replace('{itens}', $items, $list);
    print $list;
