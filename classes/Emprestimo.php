<?php


class Emprestimo
{
    private static  $conn;

    //abre uma conexão com banco de dados
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

    //Metodo para salva ou editar um registro
    public static function save($dados){
        $conn = self::getConnection();

            $query = "INSERT INTO emprestimo(data_emprestimo, emprestimo, id_aluno, id_livro) 
                        VALUES (:data_emprestimo,:emprestimo,:id_aluno,:id_livro)";

            $result =$conn->prepare($query);
            $result->execute([
                ':data_emprestimo' =>$dados['data_emprestimo'],
                ':emprestimo' =>$dados['emprestimo'],
                ':id_aluno' =>$dados['id_aluno'],
                ':id_livro' =>$dados['id_livro']
            ]);
    }

    //Metodo para busca todos emprestimo relacionado com livro e alunos
    public static function all(){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM emprestimo 
                                    INNER JOIN aluno ON emprestimo.id_aluno = aluno.codigo_aluno 
                                    INNER JOIN livro ON emprestimo.id_livro = livro.codigo_livro");
        $list = $result->fetchAll(PDO::FETCH_ASSOC);

        return $list;
    }

   //Metodo para uma busca mais completa de um emprestimo relacionado com livro e aluno
    public static function find($id){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM emprestimo 
                                            INNER JOIN aluno ON emprestimo.id_aluno = aluno.codigo_aluno 
                                            INNER JOIN livro ON emprestimo.id_livro = livro.codigo_livro
                                            INNER JOIN curso ON aluno.id_curso = curso.codigo_curso
                                            INNER join periodo ON aluno.id_periodo = periodo.codigo_periodo
                                            WHERE id_emprestimo = '{$id}'");
        $aluno = $result->fetchAll(PDO::FETCH_ASSOC);
        return $aluno;
    }

    //Metodo retorna a quantidade de emprestimo e id do emprestimo de um aluno
    public static function quantidadeEmprestado($id){
        $conn = self::getConnection();
        $result = $conn->query("SELECT emprestimo, id_emprestimo FROM emprestimo 
                                        WHERE emprestimo.id_livro = '{$id}'");
        $listquantidade = $result->fetchAll(PDO::FETCH_ASSOC);

        return $listquantidade;
    }

    //Busca um registro atraves de CPF
    public static function buscaCPF($cpf){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM aluno WHERE cpf = '{$cpf}'");
        $registro = $result->fetch(PDO::FETCH_ASSOC);

        return $registro;
    }

    //Busca um registro de emprestimo atraves de um id do aluno
    public static function registroEmprestimo($id){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM `emprestimo` 
                                            INNER JOIN aluno ON aluno.codigo_aluno = emprestimo.id_aluno
                                            WHERE id_aluno = '{$id}'");
        $registro = $result->fetchAll(PDO::FETCH_ASSOC);

        return $registro;
    }

    //Busca registros dos empréstimos realizado por um aluno
    public static function emprestimoAluno($id){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM `aluno`
                                INNER JOIN emprestimo ON emprestimo.id_aluno = aluno.codigo_aluno
                                INNER JOIN livro ON livro.codigo_livro = emprestimo.id_livro
                                WHERE codigo_aluno = '{$id}'");
        $emprestimo = $result->fetchAll(PDO::FETCH_ASSOC);

        return $emprestimo;
    }

    //Formata a data que foi efetuado um emprestimo
    public static function dataFormatada($id){
        $conn = self::getConnection();
        $result = $conn->query("SELECT data_emprestimo FROM emprestimo WHERE id_emprestimo = '{$id}'");
        $data = $result->fetch(PDO::FETCH_ASSOC);
        $data1 = $data['data_emprestimo'];
        $data_format = new DateTime($data1);

        return $data_format->format('d-m-Y');
    }

    //Formata e calcula data de entrega do livro
    public static function dataEntrega($data){
        $data = new DateTime($data);
        $add = new DateInterval('P7DT1H');
        $data->add($add);
        return $data->format('d-m-Y');
    }

    //Lenvata quantos dias de atraso na entrega do livro
    public static function diaAtraso($data){
        $hoje = new DateTime();
        $entrega = new DateTime($data);
        $diff = $entrega->diff($hoje);
        $dia = $diff->format('%R%a');
        if($dia > 0 ) {
            $dias = substr($dia, 1);
            return $dias;
        }else{
            return 0;
        }
    }

    //Calcula o valor da multa
    public static function multa($id, $atrasado){
        $conn = self::getConnection();
        $result = $conn->query("SELECT emprestimo FROM `emprestimo` WHERE id_emprestimo = '{$id}'");
        $quantidade =  $result->fetch(PDO::FETCH_ASSOC);
        $quantidade = (int)$quantidade['emprestimo'];
        $multa = 0.50 * ($quantidade * $atrasado);

        return number_format($multa,  2);
    }

    //
    public static function devolucao($id){
        $conn = self::getConnection();
        $result = $conn->query("DELETE FROM `emprestimo` WHERE id_emprestimo = '{$id}'");
    }

    //
    public static function pesquisar($pesquisar){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM emprestimo 
                                        INNER JOIN aluno ON emprestimo.id_aluno = aluno.codigo_aluno 
                                        INNER JOIN livro ON emprestimo.id_livro = livro.codigo_livro
                                        WHERE aluno.nome LIKE '{$pesquisar}%' 
                                        OR aluno.cpf LIKE '{$pesquisar}%'
                                        OR aluno.matricula LIKE '{$pesquisar}%' ");
        $all = $result->fetchAll(PDO::FETCH_ASSOC);
        return $all;
    }
}