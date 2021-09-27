<?php
include_once '../classes/EmprestimoFuncionario.php';

$teste = EmprestimoFuncionario::devolucao($_REQUEST['id']);

print "<div>";
print "<script>location='principal_bibliotecaria.php?link=7'</script>";
print "</div>";