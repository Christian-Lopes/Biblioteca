<?php


class Secretaria
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
        $result = $conn->query("SELECT nome, cpf FROM secretaria WHERE nome = '{$nome}' AND cpf
        = '{$pass}' ");
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
    public static function save($pessoa, $id_funcao){
        $conn = self::getConnection();

        if(empty($pessoa['id'])){
            $query = "INSERT INTO secretaria (nome, sobrenome, cpf, telefone, email, endereco, id_funcao)
                        VALUES(:nome, :sobrenome, :cpf, :telefone, :email, :endereco, :id_funcao)";

        }
        else{
            $query = "UPDATE pessoa SET nome = :nome,
                              endereco = :endereco,
                              bairro = :bairro,
                              telefone = :telefone,
                              email = :email,
                              id_cidade = :id_cidade 
                          WHERE id = :id ";
        }
        $result =$conn->prepare($query);
        $result->execute([
            ':nome' =>$pessoa['nome'],
            ':sobrenome' =>$pessoa['sobrenome'],
            ':cpf' =>$pessoa['cpf'],
            ':telefone' =>$pessoa['telefone'],
            ':email' =>$pessoa['email'],
            ':endereco' =>$pessoa['endereco'],
            ':id_funcao' =>$id_funcao,
        ]);


    }

}