<?php


class EmprestimoFuncionario
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
    public static function save($dados){
        $conn = self::getConnection();

        if(empty($pessoa['id'])){
            $query = "INSERT INTO emprestimo_funcionario (cod_emprestimo, emprestimo, id_funcionario, id_livro, data_emprestimo)
                        VALUES (:cod_emprestimo, :emprestimo, :id_funcionario, :id_livro, :data_emprestimo)";

            $result =$conn->prepare($query);
            $result->execute([
                ':cod_emprestimo' => null,
                ':emprestimo' => $dados['emprestimo'],
                ':id_funcionario' => $dados['id_funcionario'],
                ':id_livro' => $dados['id_livro'],
                ':data_emprestimo' => $dados['data_emprestimo'],
            ]);
        }


    }
    public static function all(){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM emprestimo_funcionario 
                                        INNER JOIN funcionario ON funcionario.codigo_funcionario = emprestimo_funcionario.id_funcionario 
                                        INNER JOIN livro ON livro.codigo_livro = emprestimo_funcionario.id_livro ");
        $list = $result->fetchAll(PDO::FETCH_ASSOC);

        return $list;
    }
    public static function delete($id){
        $conn = self::getConnection();
        $result = $conn->query("DELETE FROM aluno WHERE id='{$id}'");

        return $result;
    }
    public static function find($id){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM emprestimo_funcionario
                                        INNER JOIN funcionario ON funcionario.codigo_funcionario = emprestimo_funcionario.id_funcionario 
                                        INNER JOIN livro ON livro.codigo_livro = emprestimo_funcionario.id_livro 
                                        INNER JOIN funcao ON funcao.codigo_funcao = funcionario.id_funcao
                                        WHERE cod_emprestimo = '{$id}'");
        $aluno = $result->fetchAll(PDO::FETCH_ASSOC);
        return $aluno;
    }
    public static  function quantidadeEmprestado($id){
        $conn = self::getConnection();
        $result = $conn->query("SELECT cod_emprestimo, emprestimo FROM `emprestimo_funcionario` 
                                        WHERE emprestimo_funcionario.id_livro = '{$id}'");
        $listquantidade = $result->fetchAll(PDO::FETCH_ASSOC);

        return $listquantidade;
    }
    public static function buscaCPF($cpf){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM funcionario WHERE cpf = '{$cpf}'");
        $registro = $result->fetch(PDO::FETCH_ASSOC);

        return $registro;
    }
    public static function registroEmprestimo($id){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM `emprestimo_funcionario` 
                                            INNER JOIN funcionario ON funcionario.codigo_funcionario = emprestimo_funcionario.id_funcionario
                                            WHERE id_funcionario ='{$id}'");
        $registro = $result->fetchAll(PDO::FETCH_ASSOC);

        return $registro;
    }

    //Busca registros dos empréstimos realizado por um funcionário
    public static function emprestimoDeFuncionario($id){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM funcionario 
        INNER JOIN emprestimo_funcionario ON emprestimo_funcionario.id_funcionario = funcionario.codigo_funcionario 
        INNER JOIN livro ON livro.codigo_livro = emprestimo_funcionario.id_livro
        WHERE codigo_funcionario ='{$id}'");
        $emprestimo = $result->fetchAll(PDO::FETCH_ASSOC);

        return $emprestimo;
    }
    public static function dataFormatada($id){
        $conn = self::getConnection();
        $result = $conn->query("SELECT data_emprestimo FROM `emprestimo_funcionario` WHERE cod_emprestimo = '{$id}'");
        $data = $result->fetch(PDO::FETCH_ASSOC);
        $data1 = $data['data_emprestimo'];

        $data_format = new DateTime($data1);

        return $data_format->format('d-m-Y');

    }
    public static function dataEntrega($data){
        $data = new DateTime($data);
        $add = new DateInterval('P7DT1H');
        $data->add($add);
        return $data->format('d-m-Y');
    }
    public static function diaAtraso($data){
        $hoje = new DateTime();
        $entrega = new DateTime($data);
        $diff = $entrega->diff($hoje);

        return $diff->d;
    }
    public static function multa($id, $atrasado){
        $conn = self::getConnection();
        $result = $conn->query("SELECT emprestimo FROM `emprestimo_funcionario` WHERE cod_emprestimo = '{$id}'");
        $quantidade =  $result->fetch(PDO::FETCH_ASSOC);
        $quantidade = (int)$quantidade['emprestimo'];

        $multa = 0.50 * ($quantidade * $atrasado);

        return number_format($multa,  2);
    }
    public static function devolucao($id){
        $conn = self::getConnection();
        $result = $conn->query("DELETE FROM `emprestimo_funcionario` WHERE cod_emprestimo = '{$id}'");
        return $result;
    }
    public static function pesquisar($pesquisar){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM emprestimo_funcionario 
                        INNER JOIN funcionario ON emprestimo_funcionario.id_funcionario = funcionario.codigo_funcionario
                        INNER JOIN livro ON emprestimo_funcionario.id_livro = livro.codigo_livro
                        WHERE funcionario.nome LIKE '{$pesquisar}%' 
                        OR funcionario.cpf LIKE '{$pesquisar}%'
                        OR funcionario.matricula LIKE '{$pesquisar}%'");
        $all = $result->fetchAll(PDO::FETCH_ASSOC);
        return $all;
    }

}