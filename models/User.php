<?php
# Modelo de usuário
require_once "config/database.php";

class User {
    private $conn;
    private $table_name = "users";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($nome, $cpf, $email, $data_nascimento, $telefone, $senha) {
        $query = "INSERT INTO " . $this->table_name . " (nome, cpf, email, data_nascimento, telefone, senha) VALUES (:nome, :cpf, :email, :data_nascimento, :telefone, :senha)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":data_nascimento", $data_nascimento);
        $stmt->bindParam(":telefone", $telefone);
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt->bindParam(":senha", $senha_hash);

        return $stmt->execute();
    }

    public function readAll() {
        $query = "SELECT id, nome, cpf, email, data_nascimento, telefone FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $nome, $email, $data_nascimento, $telefone, $senha = null) {
        $query = "UPDATE " . $this->table_name . " SET nome = :nome, email = :email, data_nascimento = :data_nascimento, telefone = :telefone";
    
        if ($senha) {
            $query .= ", senha = :senha";
        }
    
        $query .= " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":data_nascimento", $data_nascimento);
        $stmt->bindParam(":telefone", $telefone);
    
        if ($senha) {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt->bindParam(":senha", $senha_hash);
        }
    
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    // Novo método para encontrar um usuário pelo ID
    public function findUserById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>