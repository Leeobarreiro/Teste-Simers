<?php
require_once "models/User.php";

class UserController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function createUser($data) {
        // Verifica se o CSRF token está definido e correto
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("Falha na verificação CSRF.");
        }
    
        // Sanitiza e valida os dados de entrada
        $data['nome'] = trim($data['nome']);
        $data['cpf'] = preg_replace('/\D/', '', trim($data['cpf']));
        $data['email'] = trim($data['email']);
        $data['data_nascimento'] = trim($data['data_nascimento']);
        $data['telefone'] = trim($data['telefone']);
        $data['senha'] = trim($data['senha']);
    
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            echo "E-mail inválido.";
            return false;
        }
    
        if (strlen($data['cpf']) != 11 || !is_numeric($data['cpf'])) {
            echo "CPF inválido.";
            return false;
        }
    
        // Verifica se todos os campos obrigatórios estão preenchidos
        if (!empty($data['nome']) && !empty($data['cpf']) && !empty($data['email']) && !empty($data['data_nascimento']) && !empty($data['telefone']) && !empty($data['senha'])) {
            $created = $this->user->create($data['nome'], $data['cpf'], $data['email'], $data['data_nascimento'], $data['telefone'], $data['senha']);
            
            if ($created) {
                header("Location: index.php?action=list&status=success");
                exit();
            }
        }
        return false;
    }

    public function listUsers() {
        return $this->user->readAll();
    }

    public function getUserById($id) {
        return $this->user->findUserById($id);
    }

    public function updateUser($id, $data) {
        // Verifica o CSRF token
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("Falha na verificação CSRF.");
        }
    
        // Sanitiza e valida os dados de entrada
        $data['nome'] = trim($data['nome']);
        $data['cpf'] = preg_replace('/\D/', '', trim($data['cpf']));
        $data['email'] = trim($data['email']);
        $data['data_nascimento'] = trim($data['data_nascimento']);
        $data['telefone'] = trim($data['telefone']);
        $data['senha'] = trim($data['senha']);
    
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            echo "E-mail inválido.";
            return false;
        }
    
        if (strlen($data['cpf']) != 11 || !is_numeric($data['cpf'])) {
            echo "CPF inválido.";
            return false;
        }
    
        // Executa a atualização e retorna o resultado
        return $this->user->update($id, $data['nome'], $data['email'], $data['data_nascimento'], $data['telefone'], $data['senha'] ?? null);
    }

    public function deleteUser($id) {
        // Verifica o CSRF token
        if (!isset($_GET['csrf_token']) || $_GET['csrf_token'] !== $_SESSION['csrf_token']) {
            die("Falha na verificação CSRF.");
        }
    
        return $this->user->delete($id);
    }
}
?>
