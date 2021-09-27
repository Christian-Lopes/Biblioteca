<?php
/* Controler ambiente da secretaria
 * Inserir um registro de um bibliotecário
 * */
include_once '../classes/Bibliotecario.php';
include_once '../classes/Alert.php';

if(!empty($_REQUEST)){
    try{
        if($_POST){
            $pessoa = $_POST;
            Bibliotecario::save($pessoa);
        }
    }catch(Exception $e){
        print $e->getMessage();
    }
}
$form = file_get_contents('../html/secretaria/inserir_bibliotecario.html');
print $form;