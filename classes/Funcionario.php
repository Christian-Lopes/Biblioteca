<?php


class Funcionario
{
    private static  $conn;

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
        $result = $conn->query("SELECT nome, cpf FROM funcionario WHERE nome = '{$nome}' AND cpf
        = '{$pass}' ");
        $logar = $result->fetch(PDO::FETCH_BOTH);

        return $logar;
    }
    public static function Deslogar() {
        if ($_SESSION['logado']) {
            unset($_SESSION['logado']);
            session_destroy();
            header("location:login.php");
        }
    }
    public static function logando(){
        $_SESSION['logado'] = true;
        return true;
    }
    public static function save($pessoa){
        $conn = self::getConnection();

        if(empty($pessoa['codigo_funcionario'])){
            $query = "INSERT INTO funcionario (nome, sobrenome, cpf, telefone, email, endereco, matricula, id_funcao)
                        VALUES(:nome, :sobrenome, :cpf, :telefone, :email, :endereco, :matricula, :id_funcao)";

            $result =$conn->prepare($query);
            $result->execute([
                ':nome' =>$pessoa['nome'],
                ':sobrenome' =>$pessoa['sobrenome'],
                ':cpf' =>$pessoa['cpf'],
                ':telefone' =>$pessoa['telefone'],
                ':email' =>$pessoa['email'],
                ':endereco' =>$pessoa['endereco'],
                ':matricula' =>$pessoa['matricula'],
                ':id_funcao' =>$pessoa['id_funcao'],

            ]);
        }
        else{
            $query = "UPDATE funcionario SET
                              codigo_funcionario = :codigo_funcionario,
                              nome = :nome,
                              sobrenome = :sobrenome,
                              cpf = :cpf,
                              telefone = :telefone,
                              email = :email,
                              endereco = :endereco,
                              matricula = :matricula,
                              id_funcao = :id_funcao
                               WHERE codigo_funcionario = :codigo_funcionario ";

            $result =$conn->prepare($query);
            $result->execute([
                ':codigo_funcionario' =>$pessoa['codigo_funcionario'],
                ':nome' =>$pessoa['nome'],
                ':sobrenome' =>$pessoa['sobrenome'],
                ':cpf' =>$pessoa['cpf'],
                ':telefone' =>$pessoa['telefone'],
                ':email' =>$pessoa['email'],
                ':endereco' =>$pessoa['endereco'],
                ':matricula' =>$pessoa['matricula'],
                ':id_funcao' =>$pessoa['id_funcao'],

            ]);
        }

    }
    public static function all(){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM funcionario ORDER BY codigo_funcionario");
        $list = $result->fetchAll(PDO::FETCH_ASSOC);

        return $list;
    }
    public static function delete($id){
        $conn = self::getConnection();
        $result = $conn->query("DELETE FROM funcionario WHERE codigo_funcionario ='{$id}'");

        return $result;
    }
    public static function find($id){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM funcionario WHERE codigo_funcionario ='{$id}'");

        return $result->fetch();
    }
    public static function getFuncionario($id){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM `funcionario` 
                                            INNER JOIN funcao ON funcao.codigo_funcao = funcionario.id_funcao
                                            WHERE codigo_funcionario = '{$id}'");

        $funcionario = $result->fetch(PDO::FETCH_ASSOC);

        return $funcionario;
    }
}