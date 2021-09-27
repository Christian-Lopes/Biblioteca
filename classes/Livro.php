<?php


class Livro
{
    private static $conn;

    public static function getConnection()
    {
        if (empty(self::$conn)) {
            $host = 'localhost';
            $name = 'biblioteca';
            $user = 'christian';
            $pass = '03195468107';
            self::$conn = new PDO("mysql:host={$host};dbname={$name}", "{$user}", "{$pass}");
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }

    public static function save($livro)
    {
        $conn = self::getConnection();

        if (empty($livro['codigo_livro'])) {
            $query = "INSERT INTO livro (titulo, subtitulo, editora, publicado, isbn, quantidade, edicao, 
                                        autor, id_categoria, id_tipo)
                        VALUES(:titulo, :subtitulo, :editora, :publicado, :isbn, :quantidade, :edicao, :autor, 
                        :id_categoria, :id_tipo)";

            $result = $conn->prepare($query);
            $result->execute([
                ':titulo' => $livro['titulo'],
                ':subtitulo' => $livro['subtitulo'],
                ':editora' => $livro['editora'],
                ':publicado' => $livro['publicado'],
                ':isbn' => $livro['isbn'],
                ':quantidade' => $livro['quantidade'],
                ':edicao' => $livro['edicao'],
                ':autor' => $livro['autor'],
                ':id_categoria' => $livro['id_categoria'],
                ':id_tipo' => $livro['id_tipo'],
            ]);
        } else {
            $query = "UPDATE livro SET 
                            codigo_livro = :codigo_livro,
                            titulo = :titulo,
                            subtitulo = :subtitulo, 
                            editora = :editora, 
                            publicado = :publicado, 
                            isbn = :isbn,
                            quantidade = :quantidade, 
                            edicao = :edicao, 
                            autor = :autor,
                            id_categoria = :id_categoria,
                            id_tipo = :id_tipo
                          WHERE codigo_livro = :codigo_livro";

            $result = $conn->prepare($query);
            $result->execute([
                ':codigo_livro' => $livro['codigo_livro'],
                ':titulo' => $livro['titulo'],
                ':subtitulo' => $livro['subtitulo'],
                ':editora' => $livro['editora'],
                ':publicado' => $livro['publicado'],
                ':isbn' => $livro['isbn'],
                ':quantidade' => $livro['quantidade'],
                ':edicao' => $livro['edicao'],
                ':autor' => $livro['autor'],
                ':id_categoria' => $livro['id_categoria'],
                ':id_tipo' => $livro['id_tipo'],
            ]);
        }
    }

    public static function all()
    {
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM `livro` 
                                    INNER JOIN categoria ON categoria.codigo_categoria = livro.id_categoria
                                    INNER JOIN tipo ON tipo.codigo_tipo = livro.id_tipo");
        $list = $result->fetchAll(PDO::FETCH_ASSOC);

        return $list;
    }

    public static function delete($id)
    {
        $conn = self::getConnection();
        $result = $conn->query("DELETE FROM livro WHERE codigo_livro='{$id}'");

        return $result;
    }

    public static function find($id)
    {
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM livro WHERE codigo_livro='{$id}'");

        return $result->fetch();
    }

    public static function getLivro($id){
        $conn = self::getConnection();
        $result = $conn->query("SELECT * FROM `livro` 
                                        INNER JOIN categoria ON categoria.codigo_categoria = livro.id_categoria
                                        INNER JOIN tipo ON tipo.codigo_tipo = livro.id_tipo
                                        where codigo_livro = '{$id}'");
        $livro = $result->fetch(PDO::FETCH_ASSOC);

        return $livro;
    }

    public static function pesquisaLivro($pesquisa){
        $conn = self::getConnection();

        $result = $conn->query("SELECT * FROM `livro`
                                INNER JOIN tipo ON tipo.codigo_tipo = livro.id_tipo
                                INNER JOIN categoria on categoria.codigo_categoria = livro.id_categoria
                                WHERE livro.titulo LIKE '{$pesquisa}%'
                                OR categoria.categoria LIKE '{$pesquisa}%'
                                OR livro.autor LIKE '{$pesquisa}%'");
        $all = $result->fetchAll(PDO::FETCH_ASSOC);

        return $all;
    }
}