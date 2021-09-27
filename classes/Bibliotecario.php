<?php

class Bibliotecario
{
    private static $conn;

    public static function getConnection(){
        if(empty(self::$conn)){
            $host = 'localhost' ;
            $name = 'biblioteca';
            $user = 'christian';
            $pass = '03195468107';
            self::$conn = new PDO("mysql:host={$host};dbname={$name}", "{$user}", "{$pass}");
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }
    public static function logar($nome, $pass){
        $conn = self::getConnection();
        $result = $conn->query("SELECT nome, cpf FROM bibliotecario WHERE nome = '{$nome}' AND cpf
        = '{$pass}'");
        $logar = $result->fetch(PDO::FETCH_BOTH);

        return $logar;
    }
    public static function Deslogar() {
        if ($_SESSION['logado']) {
            unset($_SESSION['logado']);
            session_destroy();
        }
    }
    public static function logando(){
        $_SESSION['logado'] = true;
        return true;
    }
    public static function save($pessoa){
        $conn = self::getConnection();

        if(empty($pessoa['codigo_bibliotecario'])){
            $query = "INSERT INTO bibliotecario ( nome, sobrenome, cpf, telefone, email, endereco, matricula)
                        VALUES(:nome, :sobrenome, :cpf, :telefone, :email, :endereco, :matricula)";
            $result =$conn->prepare($query);
            $result->execute([

                ':nome' =>$pessoa['nome'],
                ':sobrenome' =>$pessoa['sobrenome'],
                ':cpf' =>$pessoa['cpf'],
                ':telefone' =>$pessoa['telefone'],
                ':email' =>$pessoa['email'],
                ':endereco' =>$pessoa['endereco'],
                ':matricula' =>$pessoa['matricula'],

            ]);

        }
        else{
            $query = "UPDATE bibliotecario SET 
                              codigo_bibliotecario = :codigo_bibliotecario,
                              nome = :nome,
                              sobrenome = :sobrenome,
                              cpf = :cpf,
                              telefone = :telefone,
                              email = :email,
                              endereco = :endereco,
                              matricula = :matricula 
                          WHERE codigo_bibliotecario = :codigo_bibliotecario ";

            $result =$conn->prepare($query);
            $result->execute([
                ':codigo_bibliotecario' => $pessoa['codigo_bibliotecario'],
                ':nome' =>$pessoa['nome'],
                ':sobrenome' =>$pessoa['sobrenome'],
                ':cpf' =>$pessoa['cpf'],
                ':telefone' =>$pessoa['telefone'],
                ':email' =>$pessoa['email'],
                ':endereco' =>$pessoa['endereco'],
                ':matricula' =>$pessoa['matricula'],

            ]);
        }

    }
    public static function all(){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM bibliotecario ORDER BY codigo_bibliotecario");
        $list = $result->fetchAll(PDO::FETCH_ASSOC);

        return $list;
    }
    public static function delete($id){
        $conn = self::getConnection();
        $result = $conn->query("DELETE FROM bibliotecario WHERE codigo_bibliotecario ='{$id}'");

        return $result;
    }
    public static function find($id){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM bibliotecario WHERE codigo_bibliotecario = '{$id}'");

        return $result->fetch();
    }
    public static function getBibliotecario($id){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM bibliotecario WHERE codigo_bibliotecario = '{$id}'");
        $bibliotecario = $result->fetch(PDO::FETCH_ASSOC);

        return $bibliotecario;
    }
    public static function formatTelefone($telefone){
        $telefone = (string) $telefone;
        $ddd = substr($telefone, 0,2);
        $parte1 = substr($telefone, 2, 5);
        $parte2 = substr($telefone, 7,10);

        $formatado = "(" . $ddd . ") " . $parte1 . "-" . $parte2;
        return $formatado;
    }
    public static function pesquisar($pesquisar){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM bibliotecario WHERE nome LIKE '{$pesquisar}%' OR matricula LIKE '{$pesquisar}%' ");
        $all = $result->fetchAll(PDO::FETCH_ASSOC);
        return $all;
    }
}