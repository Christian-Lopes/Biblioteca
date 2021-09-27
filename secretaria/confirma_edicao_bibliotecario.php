<?php
/* Controler ambiente da secretaria
 * Confirmar registro de um bibliotecário
 * */
include_once '../classes/Bibliotecario.php';

try {
    $pessoa = $_REQUEST;
    Bibliotecario::save($pessoa);

    print "<script>location='principal_secretaria.php?link=2'</script>";
    print "</div>";
}catch (Exception $e){
    print $e->getMessage();
}