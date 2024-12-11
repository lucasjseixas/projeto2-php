<?php

namespace App\Controller;

include_once __DIR__ . '/../Core/autoload.php';

use App\Model\UsuarioModel;
use \Exception;

class UsuarioController
{
    public function criarUsuario(string $nome, string $email, string $senha)
    {
        try {
            $usuario = new UsuarioModel(null, $nome, $email, $senha);
            $usuario->inserirUsuario();
        } catch (Exception $e) {
            echo 'Erro ao criar Usuário: ' . $e->getMessage();
        }
    }

    public function deletarUsuario(int $id)
    {
        try {
            $usuario = UsuarioModel::buscarUsuarioPorId($id);
            if ($usuario) {
                if ($usuario->deletarUsuario())
                    echo 'Usuário deletado com sucesso!';
                else {
                    echo 'Erro ao deletar usuário!';
                }
            } else {
                echo 'Usuário não encontrado';
            }
        } catch (Exception $e) {
            echo 'Erro ao deletar usuário ' . $e->getMessage();
        }
    }

    public function buscarUsuarioPorId(int $id)
    {
        try {
            $usuario = UsuarioModel::buscarUsuarioPorId($id);
            if ($usuario) {
                echo "Usuário encontrado: <br>";
                echo "ID: " . $usuario->getId() . "<br>";
                echo "nome: " . $usuario->getNome() . "<br>";
                echo "email: " . $usuario->getEmail() . "<br>";
            } else {
                echo 'Usuário não encontrado';
            }
        } catch (Exception $e) {
            echo 'Erro ao buscar usuário: ' . $e->getMessage();
        }
    }
}

// Verifica se a requisição é POST e se a tag "cadastrar" foi enviada
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'cadastrar') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $controller = new UsuarioController();
    $controller->criarUsuario($nome, $email, $senha); // Chama o método para criar o usuário
}
