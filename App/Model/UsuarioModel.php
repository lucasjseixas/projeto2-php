<?php

namespace App\Model;

include_once __DIR__ . '/../Core/autoload.php';

use Database\DB;
use \PDO;
use \InvalidArgumentException;

class UsuarioModel extends DB
{
    private ?int $id;
    private string $nome;
    private string $email;
    private string $senha;

    public function __construct(?int $id, string $nome, string $email, string $senha)
    {
        parent::__construct(); // Ao herdar DB, posso chamar a função construct de DB para executar a conexão com o DB diretamente
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }

    /*
     * Getters e Setters 
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }
    public function setId(?int $id)
    {
        $this->id = $id;
    }

    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setSenha(string $senha)
    {
        $this->senha = $senha;
    }

    public function inserirUsuario(): void
    {
        if ($this->id === null) {
            $sql = "INSERT INTO `Usuario` (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([
                ':nome' => $this->nome,
                ':email' => $this->email,
                ':senha' => password_hash($this->senha, PASSWORD_DEFAULT),
            ]);
            $this->id = $this->getConnection()->lastInsertId(); // Após um Insert bem sucedido, com o retorno do banco de dados, atribui o campo 'ID'
        } else {
            $sql = "UPDATE `Usuario` SET nome = :nome, email = :email, senha = :senha WHERE id = :id";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([
                ':nome' => $this->nome,
                ':email' => $this->email,
                ':senha' => password_hash($this->senha, PASSWORD_DEFAULT),
            ]);
        }
    }

    public function deletarUsuario(): bool
    {
        if ($this->id === null) {
            throw new InvalidArgumentException("ID não pode ser nulo para deletar.");
        }
        $sql = "DELETE FROM Usuario WHERE id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        return $stmt->execute([':id' => $this->id]);
    }

    /*
     * Busca um usuário pelo ID
     */
    public static function buscarUsuarioPorId(int $id): ?UsuarioModel
    {
        $sql = "SELECT * FROM Usuario WHERE id = :id";
        $stmt = DB::getInstance()->getConnection()->prepare($sql);
        $stmt->execute([':id' => $id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new UsuarioModel($result['id'], $result['nome'], $result['email'], $result['senha']);
        }
        return null;
    }
}
