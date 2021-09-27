<?php


class Gerais
{

    public function formatarTelefone($telefone){

        $ddd = substr($telefone, 0, 1);

        return $ddd;
    }
}