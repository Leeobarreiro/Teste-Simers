<!-- views/create.php -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Novo Usuário</title>
</head>
<body>
    <h2>Cadastrar Novo Usuário</h2>
    <form action="index.php?action=create" method="POST">
        <label>Nome:</label><input type="text" name="nome" required><br>
        <label>CPF:</label><input type="text" name="cpf" required><br>
        <label>E-mail:</label><input type="email" name="email" required><br>
        <label>Data de Nascimento:</label><input type="date" name="data_nascimento" required><br>
        <label>Telefone:</label><input type="text" name="telefone" required><br>
        <label>Senha:</label><input type="password" name="senha" required><br>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
