<?php
include_once '../../classes/Aluno.php';

try {
    $pessoa = $_REQUEST;

    Aluno::save($pessoa);
    print "<div>";
    print "<script>location='../principal_bibliotecaria.php?link=2'</script>";
    print "</div>";
}catch (Exception $e){
    print $e->getMessage();
}
