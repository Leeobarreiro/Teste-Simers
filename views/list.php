

<h2 class="mb-4">Lista de Usuários</h2>
<a href="index.php?action=create" class="btn btn-success mb-3">Cadastrar Novo Usuário</a>
<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>E-mail</th>
            <th>Data de Nascimento</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['nome']; ?></td>
                <td><?php echo $user['cpf']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['data_nascimento']; ?></td>
                <td><?php echo $user['telefone']; ?></td>
                <td>
                    <a href="index.php?action=edit&id=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="index.php?action=delete&id=<?php echo $user['id']; ?>&csrf_token=<?php echo $_SESSION['csrf_token']; ?>" 
                        class="btn btn-danger btn-sm" 
                        onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

