<?php
/* Controler ambiente aluno
 * Pesquisa do livro selecionado
 * */
include_once '../classes/Livro.php';
include_once '../classes/Categoria.php';
include_once '../classes/Tipo.php';
include_once '../classes/EmprestimoFuncionario.php';
include_once '../classes/Emprestimo.php';

$id = $_REQUEST['codigo_livro'];
$emprestadoAluno = Emprestimo::quantidadeEmprestado($id);
$resultadoLivro = 0;
foreach ($emprestadoAluno as $livro) {
    $resultadoLivro = $resultadoLivro + $livro['emprestimo'];
}

//busca a quantidade de um livro, que já foi emprestado para funcionários
$emprestadoFuncionario = EmprestimoFuncionario::quantidadeEmprestado($id);
$resultadoLivro;
foreach ($emprestadoFuncionario as $livro) {
    $resultadoLivro = $resultadoLivro + $livro['emprestimo'];
}

$livro = Livro::getLivro($_REQUEST['codigo_livro']);

$disponivel = $livro['quantidade'] - $resultadoLivro;

$form = file_get_contents('../html/funcionario/selecionar_livro.html');
$form = str_replace('{id}', $livro['codigo_livro'], $form);
$form = str_replace('{titulo}', $livro['titulo'], $form);
$form = str_replace('{subtitulo}', $livro['subtitulo'], $form);
$form = str_replace('{editora}', $livro['editora'], $form);
$form = str_replace('{publicado}', $livro['publicado'], $form);
$form = str_replace('{isbn}', $livro['isbn'], $form);
$form = str_replace('{quantidade}', $livro['quantidade'], $form);
$form = str_replace('{edicao}', $livro['edicao'], $form);
$form = str_replace('{autor}', $livro['autor'], $form);
$form = str_replace('{id_categoria}', $livro['id_categoria'], $form);
$form = str_replace('{id_tipo}', $livro['id_tipo'], $form);
$form = str_replace('{categoria}', $livro['categoria'], $form);
$form = str_replace('{tipo}', $livro['tipo'], $form);
$form = str_replace('{disponivel}', $disponivel, $form);
print $form;