<?php

class Aluno
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
        $result = $conn->query("SELECT nome, cpf FROM aluno WHERE nome = '{$nome}' AND cpf
        = '{$pass}'");
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

        if(empty($pessoa['codigo_aluno'])){
            $query = "INSERT INTO aluno (nome, sobrenome, cpf, telefone, email, endereco, matricula, id_periodo, id_curso)
                        VALUES(:nome, :sobrenome, :cpf, :telefone, :email, :endereco, :matricula, :id_periodo, :id_curso)";

            $result =$conn->prepare($query);
            $result->execute([
                ':nome' =>$pessoa['nome'],
                ':sobrenome' =>$pessoa['sobrenome'],
                ':cpf' =>$pessoa['cpf'],
                ':telefone' =>$pessoa['telefone'],
                ':email' =>$pessoa['email'],
                ':endereco' =>$pessoa['endereco'],
                ':matricula' =>$pessoa['matricula'],
                ':id_periodo' =>$pessoa['id_periodo'],
                ':id_curso' =>$pessoa['id_curso'],
            ]);
        }
        else{
            $query = "UPDATE aluno SET
                              codigo_aluno = :codigo_aluno,
                              nome = :nome,
                              sobrenome = :sobrenome,
                              cpf = :cpf,
                              telefone = :telefone,
                              email = :email,
                              endereco = :endereco,
                              matricula = :matricula,
                              id_periodo = :id_periodo,
                              id_curso = :id_curso   
                          WHERE codigo_aluno = :codigo_aluno ";

            $result =$conn->prepare($query);
            $result->execute([
                ':codigo_aluno' =>$pessoa['codigo_aluno'],
                ':nome' =>$pessoa['nome'],
                ':sobrenome' =>$pessoa['sobrenome'],
                ':cpf' =>$pessoa['cpf'],
                ':telefone' =>$pessoa['telefone'],
                ':email' =>$pessoa['email'],
                ':endereco' =>$pessoa['endereco'],
                ':matricula' =>$pessoa['matricula'],
                ':id_periodo' =>$pessoa['id_periodo'],
                ':id_curso' =>$pessoa['id_curso'],
            ]);
        }
    }
    public static function all(){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM aluno ORDER BY codigo_aluno");
        $list = $result->fetchAll(PDO::FETCH_ASSOC);

        return $list;
    }
    public static function delete($id){
        $conn = self::getConnection();
        $result = $conn->query("DELETE FROM aluno WHERE codigo_aluno ='{$id}'");

        return $result;
    }
    public static function find($id){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM aluno WHERE codigo_aluno='{$id}'");

        return $result->fetch();
    }
    public static function getAluno($id){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM aluno 
                                        INNER JOIN curso ON curso.codigo_curso = aluno.id_curso
                                        INNER JOIN periodo ON periodo.codigo_periodo = aluno.id_periodo
                                        WHERE codigo_aluno ='{$id}' ");
        $aluno =$result->fetch(PDO::FETCH_ASSOC);
        return $aluno;
    }
}