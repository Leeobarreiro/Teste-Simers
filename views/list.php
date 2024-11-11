<!-- views/list.php -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
</head>
<body>
    <h2>Lista de Usuários</h2>
    <a href="index.php?action=create">Cadastrar Novo Usuário</a>
    <table border="1">
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>E-mail</th>
            <th>Data de Nascimento</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['nome']; ?></td>
                <td><?php echo $user['cpf']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['data_nascimento']; ?></td>
                <td><?php echo $user['telefone']; ?></td>
                <td>
                    <a href="index.php?action=edit&id=<?php echo $user['id']; ?>">Editar</a> |
                    <a href="index.php?action=delete&id=<?php echo $user['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
