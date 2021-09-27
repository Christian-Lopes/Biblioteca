
<?php

$id = filter_input(INPUT_GET, 'codigo_funcionario');
include_once '../classes/Funcionario.php';

try {
    if (!empty($id)) {
        if (Funcionario::delete($id)) {
            print "<div>";
            print "<script>location='principal_bibliotecaria.php?link=3'</script>";
            print "</div>";
        } else {
            print "<div>";
            print "<script>alert('Registro não foi excluido!')</script>";
            print "<script>location='principal.php?link=5'</script>";
            print "</div>";
        }
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
    echo $exc->getMessage();
}
