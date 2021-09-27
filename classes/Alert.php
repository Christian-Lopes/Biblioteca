<?php


class Alert
{
    public static function mensagem($mensagem, $local){
        $alerta =  "<script> alert('{$mensagem}'); location='{$local}'</script>";


        return print $alerta;
    }
}

