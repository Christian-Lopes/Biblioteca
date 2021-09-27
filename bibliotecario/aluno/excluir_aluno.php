<?php

$id = filter_input(INPUT_GET, 'id');
include_once '../classes/Aluno.php';
include_once '../classes/Alert.php';

try {
    if (!empty($id)) {
        if (Aluno::delete($id)) {
            //Alert::mensagem('Registro excluido com sucesso!', 'principal_bibliotecaria.php?link=2');
            print "<div>";
            print "<script>location='principal_bibliotecaria.php?link=2'</script>";
            print "</div>";
        } else {
            print "<div>";
            print "<script>alert('Registro não foi excluido!')</script>";
            print "<script>location='principal.php?link=5'</script>";
            print "</div>";
        }
    } else {
        print "<div>";
        print "<script>alert('Reconhecido não reconhecido!')</script>";
        print "<script>location='principal.php?link=5'</script>";
        print "</div>";
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
    echo $exc->getMessage();
}
