<?php

include_once '../classes/Aluno.php';
include_once '../classes/Curso.php';
include_once '../classes/Periodo.php';

$pessoa = Aluno::find($_REQUEST['id']);

$form = file_get_contents('../html/bibliotecario/editar_aluno.html');

$form = str_replace('{id}', $pessoa['codigo_aluno'], $form);
$form = str_replace('{nome}', $pessoa['nome'], $form);
$form = str_replace('{sobrenome}', $pessoa['sobrenome'], $form);
$form = str_replace('{cpf}', $pessoa['cpf'], $form);
$form = str_replace('{telefone}', $pessoa['telefone'], $form);
$form = str_replace('{email}', $pessoa['email'], $form);
$form = str_replace('{matricula}', $pessoa['matricula'], $form);
$form = str_replace('{endereco}', $pessoa['endereco'], $form);
$form = str_replace('{id_curso}', $pessoa['id_curso'], $form);
$form = str_replace('{id_periodo}', $pessoa['id_periodo'], $form);

$cursos = '';
foreach (Curso::all() as $curso) {
    $check = ($curso['codigo_curso'] == $pessoa['id_curso']) ? 'selected=1' : '';
    $cursos .= "<option $check value='{$curso['codigo_curso']}'>{$curso['curso']}</option>\n";
}
$form = str_replace('{cursos}', $cursos, $form);

$periodos = '';
foreach (Periodo::all() as $periodo) {
    $check = ($periodo['codigo_periodo'] == $pessoa['id_periodo']) ? 'selected=1' : '';
    $periodos .= "<option $check value='{$periodo['codigo_periodo']}'>{$periodo['periodo']}</option>\n";
}

$form = str_replace('{periodos}', $periodos, $form);
print $form;

