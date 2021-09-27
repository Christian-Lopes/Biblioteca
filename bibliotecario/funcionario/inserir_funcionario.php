<?php
include_once '../classes/Funcionario.php';
include_once '../classes/Funcao.php';

if (!empty($_REQUEST)) {
    try {
        if ($_POST) {
            $pessoa = $_POST;
            Funcionario::save($pessoa);
        }
    } catch (Exception $e) {
        print $e->getMessage();
    }
}

$form = file_get_contents('../html/bibliotecario/inserir_funcionario.html');

$rows = '';
foreach (Funcao::all() as $row) {
    $check = ($row['codigo_funcao'] == $row['funcao']) ? 'selected=1' : '';
    $rows .= "<option $check value='{$row['codigo_funcao']}'>{$row['funcao']}</option>\n";
}
$form = str_replace('{cursos}', $rows, $form);

print $form;


