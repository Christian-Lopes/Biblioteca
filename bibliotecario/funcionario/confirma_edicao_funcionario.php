
<?php
include_once '../../classes/Funcionario.php';

try {

    $pessoa = $_REQUEST;

    Funcionario::save($pessoa);
    print "<div>";
    print "<script>location='../principal_bibliotecaria.php?link=3'</script>";
    print "</div>";
}catch (Exception $e){
    print $e->getMessage();
}

