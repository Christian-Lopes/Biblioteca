<?php

include_once '../classes/Curso.php';
include_once '../classes/Periodo.php';
include_once '../classes/Alert.php';
include_once '../classes/Aluno.php';

if (!empty($_REQUEST)) {
    try {
        if ($_POST) {
            $pessoa = $_POST;
            Aluno::save($pessoa);
        }

    } catch (Exception $e) {
        print $e->getMessage();
    }
}

$form = file_get_contents('../html/bibliotecario/inserir_aluno.html');

$cursos = '';
foreach (Curso::all() as $curso) {
    $check = ($curso['codigo_curso'] == $curso['curso']) ? 'selected=1' : '';
    $cursos .= "<option $check value='{$curso['codigo_curso']}'>{$curso['curso']}</option>\n";
}
$form = str_replace('{cursos}', $cursos, $form);

$periodos = '';
foreach (Periodo::all() as $periodo) {
    $check = ($periodo['codigo_periodo'] == $periodo['periodo']) ? 'selected=1' : '';
    $periodos .= "<option $check value='{$periodo['codigo_periodo']}'>{$periodo['periodo']}</option>\n";
}

$form = str_replace('{periodos}', $periodos, $form);
print $form;

