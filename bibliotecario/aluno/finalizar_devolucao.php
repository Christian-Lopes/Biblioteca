
<?php
include_once '../classes/Emprestimo.php';
$id = $_REQUEST['id'];
Emprestimo::devolucao($id);
print "<div>";
print "<script>location='principal_bibliotecaria.php?link=8'</script>";
print "</div>";


