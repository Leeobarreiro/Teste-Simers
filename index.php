<?php
# Arquivo inicial

session_start();
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

require_once "controllers/UserController.php";

$controller = new UserController();
$action = $_GET['action'] ?? 'list';

if (isset($_GET['status']) && $_GET['status'] === 'success') {
    echo "<p style='color: green;'>Usuário criado com sucesso!</p>";
}

switch ($action) {
    case 'create':
        if ($_POST) {
            $controller->createUser($_POST);
        }
        include "views/create.php";
        break;
    case 'edit':
        if ($_POST && isset($_GET['id'])) {
            $controller->updateUser($_GET['id'], $_POST);
        }
        include "views/edit.php";
        break;
    case 'delete':
        if (isset($_GET['id'])) {
            $controller->deleteUser($_GET['id']);
        }
        header("Location: index.php?action=list");
        break;
    case 'list':
    default:
        $users = $controller->listUsers();
        include "views/list.php";
        break;
}
?>