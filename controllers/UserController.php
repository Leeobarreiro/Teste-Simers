<?php
# Controlador de usuários

require_once "models/User.php";

class UserController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function createUser($data) {
        if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("Falha na verificação CSRF.");
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            echo "E-mail inválido.";
            return false;
        }

        if (strlen($data['cpf']) != 11 || !is_numeric($data['cpf'])) {
            echo "CPF inválido.";
            return false;
        }

        if (!empty($data['nome']) && !empty($data['cpf']) && !empty($data['email']) && !empty($data['data_nascimento']) && !empty($data['telefone']) && !empty($data['senha'])) {
            return $this->user->create($data['nome'], $data['cpf'], $data['email'], $data['data_nascimento'], $data['telefone'], $data['senha']);
        }
        return false;
    }

    public function listUsers() {
        return $this->user->readAll();
    }

    public function updateUser($id, $data) {
        if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("Falha na verificação CSRF.");
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            echo "E-mail inválido.";
            return false;
        }

        return $this->user->update($id, $data['nome'], $data['email'], $data['data_nascimento'], $data['telefone'], $data['senha'] ?? null);
    }

    public function deleteUser($id) {
        if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("Falha na verificação CSRF.");
        }

        return $this->user->delete($id);
    }
}
?>
