<?php

include_once '../classes/Livro.php';
if($_REQUEST['quantidade'] <= 0 ){
    $id = $_REQUEST['codigo_livro'];
    echo 'Livro não disponível';
    print "<div>";
    print "<script> alert('Livro indisponível!')</script>";
    print "<script>location='principal_bibliotecaria.php?link=18&codigo_livro={$id}'</script>";
    print "</div>";
}else{
    $date = new DateTime();
    $hoje = new DateTime();
    $add = new DateInterval('P7DT1H');
    $date->add($add);
    $previsaoDate = $date->format('d-m-Y');
    //cpf  quantdade
    //se é funcioinario ou aluno
    //quantdade livro
    $livro = Livro::getLivro($_REQUEST['codigo_livro']);
    $form = file_get_contents('../html/bibliotecario/informacao_emprestimo.html');
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
    $form = str_replace('{disponivel}', $_REQUEST['quantidade'], $form);

    $form = str_replace('{data_emprestimo}', $hoje->format('d-m-Y'), $form);
    $form = str_replace('{data_devolucao}', $previsaoDate , $form);

    print $form;
}