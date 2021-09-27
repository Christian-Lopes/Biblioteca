<?php
/* Controler ambiente da secretaria
 * Deletar registro de um bibliotecário
 * */
$id = filter_input(INPUT_GET, 'id');
include_once '../classes/Bibliotecario.php';

try {
    if (!empty($id)) {
        if (Bibliotecario::delete($id)) {
            print "<div>";
            print "<script>location='principal_secretaria.php?link=2'</script>";
            print "</div>";
        } else {
            print "<div>";
            print "<script>location='principal.php?link=5'</script>";
            print "</div>";
        }
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
    echo $exc->getMessage();
}