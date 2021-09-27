<?php
include_once '../../classes/Livro.php';

try {

    $livro = $_REQUEST;
    Livro::save($livro);
    print "<div>";
    print "<script>location='../principal_bibliotecaria.php?link=1'</script>";
    print "</div>";
}catch (Exception $e){
    print $e->getMessage();
}
