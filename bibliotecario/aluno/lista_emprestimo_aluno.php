
<?php
include_once '../classes/Emprestimo.php';

try{
    $emprestimos = Emprestimo::all();

}catch (Exception $e){
    print $e->getMessage();
}
$items = '';
foreach ($emprestimos as $row) {
    $item = file_get_contents('../html/bibliotecario/item_empre_aluno.html');
    $item = str_replace('{id}', $row['id_emprestimo'], $item);
    $item = str_replace('{nome}', $row['nome'], $item);
    $item = str_replace('{titulo}', $row['titulo'], $item);
    $item = str_replace('{cpf}', $row['cpf'], $item);
    $item = str_replace('{telefone}', $row['telefone'], $item);

    $items .= $item;
}

$list = file_get_contents('../html/bibliotecario/list_empre_aluno.html');
$list = str_replace('{itens}', $items, $list);
print $list;

