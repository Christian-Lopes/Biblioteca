<?php

$id = filter_input(INPUT_GET, 'id');
include_once '../classes/Livro.php';

try {

    if (!empty($id)) {
        if (Livro::delete($id)) {
            print "<div>";
            print "<script>location='principal_bibliotecaria.php?link=1'</script>";
            print "</div>";
        } else {
            print "<div>";
            print "<script>alert('Registro não foi excluido!')</script>";
            print "<script>location='principal_bibliotecaria.php?link=1'</script>";
            print "</div>";
        }
    }
} catch (Exception $exc) {
    print "<div>";
    print "<script>alert('Registro não excluido! Livro emprestado!')</script>";
    print "<script>location='principal_bibliotecaria.php?link=1'</script>";
    print "</div>";
}
