
<?php
require_once '../classes/EmprestimoFuncionario.php';

$emprestimos = EmprestimoFuncionario::all();

$itens = '';
foreach ($emprestimos as $row) {
    $item = file_get_contents('../html/bibliotecario/item_empre_funcionario.html');
    $item = str_replace('{id}', $row['cod_emprestimo'], $item);
    $item = str_replace('{nome}', $row['nome'], $item);
    $item = str_replace('{cpf}', $row['cpf'], $item);
    $item = str_replace('{telefone}', $row['telefone'], $item);
    $item = str_replace('{titulo}', $row['titulo'], $item);
    $itens .= $item;
}

$list = file_get_contents('../html/bibliotecario/list_empre_funcionario.html');
$list = str_replace('{itens}', $itens, $list);
print $list;

