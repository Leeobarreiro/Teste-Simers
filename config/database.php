<?php
# Configuração do banco de dados

class Database {
    private $host = "localhost";
    private $db_name = "cadastro";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            // Conecta ao MySQL sem o banco de dados específico para criar o banco, se necessário
            $tempConn = new PDO("mysql:host=" . $this->host, $this->username, $this->password);
            $tempConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Cria o banco de dados se ele não existir
            $tempConn->exec("CREATE DATABASE IF NOT EXISTS " . $this->db_name);

            // Agora conecta ao banco específico
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Cria a tabela `users` caso ela não exista
            $this->createUsersTable();
            
        } catch (PDOException $exception) {
            echo "Erro na conexão: " . $exception->getMessage();
        }

        return $this->conn;
    }

    private function createUsersTable() {
        // SQL para criar a tabela `users`
        $sql = "CREATE TABLE IF NOT EXISTS users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nome VARCHAR(255) NOT NULL,
                    cpf VARCHAR(11) NOT NULL,
                    email VARCHAR(255) NOT NULL,
                    data_nascimento DATE NOT NULL,
                    telefone VARCHAR(15),
                    senha VARCHAR(255) NOT NULL
                )";

        // Executa o SQL de criação da tabela
        $this->conn->exec($sql);
    }
}
?>