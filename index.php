<?php
# Arquivo inicial

session_start();
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

require_once "controllers/UserController.php";

$controller = new UserController();
$action = $_GET['action'] ?? 'list';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        
        <?php 
        // Exibe mensagens de sucesso com base no parâmetro `status`
        if (isset($_GET['status'])) {
            if ($_GET['status'] === 'success') {
                echo "<div class='alert alert-success'>Usuário criado com sucesso!</div>";
            } elseif ($_GET['status'] === 'updated') {
                echo "<div class='alert alert-success'>Usuário atualizado com sucesso!</div>";
            } elseif ($_GET['status'] === 'deleted') {
                echo "<div class='alert alert-success'>Usuário deletado com sucesso!</div>";
            }
        }
        ?>

        <?php
        switch ($action) {
            case 'create':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->createUser($_POST);
                }
                include "views/create.php";
                break;

            case 'edit':
                if (isset($_GET['id'])) {
                    $user = $controller->getUserById($_GET['id']);
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $updated = $controller->updateUser($_GET['id'], $_POST);
                        if ($updated) {
                            header("Location: index.php?action=list&status=updated");
                            exit();
                        } else {
                            echo "<div class='alert alert-danger'>Erro ao atualizar o usuário.</div>";
                        }
                    }
                } else {
                    echo "<div class='alert alert-danger'>ID do usuário não fornecido para edição.</div>";
                }
                include "views/edit.php";
                break;

            case 'delete':
                if (isset($_GET['id'])) {
                    $controller->deleteUser($_GET['id']);
                    header("Location: index.php?action=list&status=deleted");
                    exit();
                }
                break;

            case 'list':
            default:
                $users = $controller->listUsers();
                include "views/list.php";
                break;
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>