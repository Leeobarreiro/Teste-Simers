<!-- views/edit.php -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
</head>
<body>
    <h2>Editar Usuário</h2>
    <form action="index.php?action=edit&id=<?php echo $_GET['id']; ?>" method="POST">
        <label>Nome:</label><input type="text" name="nome" value="<?php echo $user['nome']; ?>" required><br>
        <label>E-mail:</label><input type="email" name="email" value="<?php echo $user['email']; ?>" required><br>
        <label>Data de Nascimento:</label><input type="date" name="data_nascimento" value="<?php echo $user['data_nascimento']; ?>" required><br>
        <label>Telefone:</label><input type="text" name="telefone" value="<?php echo $user['telefone']; ?>" required><br>
        <label>Senha (deixe em branco para não alterar):</label><input type="password" name="senha"><br>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
