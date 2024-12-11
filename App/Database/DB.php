<?php

/*
 * Assumindo uma aproximação 'Singleton Pattern' para conexão ao DB
 */

namespace Database;

use \PDO;
use \PDOException;

class DB
{
    /*
     * Para facilidade do projeto seta o HOST, o DB, o SUPERUSER ('root') e a SENHA
     */
    const HOST = 'localhost';
    const NAMEDB = 'projeto2';
    const USER = 'root';
    const PASS = '';

    private static ?DB $instance = null;
    private PDO $connection;

    /*
     * Chama a função para conexão com o banco de dados
     */
    public function __construct()
    {
        $this->setConnection();
    }

    /*
     * Try / Catch para tentativa de conexão com o banco de dados
     */
    private function setConnection(): void
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAMEDB, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new PDOException('Erro ao conectar ao banco de dados: ' . $e->getMessage());
        }
    }

    /*
     * Retorna a instância única da classe DB (implementação do padrão Singleton) (Não utilizada até o momento)
     */
    public static function getInstance(): DB
    {
        if (self::$instance === null) {
            self::$instance = new DB();
        }
        // Garante que a conexão esteja inicializada
        if (self::$instance->connection === null) {
            self::$instance->setConnection();
        }
        return self::$instance;
    }

    /*
     * Criado para acesso externo ao DB 
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
