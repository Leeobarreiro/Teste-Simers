<h2 class="mb-4">Editar Usuário</h2>

<?php if (isset($user)): ?>
    <form action="index.php?action=edit&id=<?php echo $_GET['id']; ?>" method="POST">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo htmlspecialchars($user['nome']); ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label>CPF:</label>
            <input type="text" name="cpf" value="<?php echo htmlspecialchars($user['cpf']); ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label>E-mail:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Data de Nascimento:</label>
            <input type="date" name="data_nascimento" value="<?php echo htmlspecialchars($user['data_nascimento']); ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" name="telefone" value="<?php echo htmlspecialchars($user['telefone']); ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Senha (deixe em branco para não alterar):</label>
            <input type="password" name="senha" class="form-control">
        </div>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
<?php else: ?>
    <div class="alert alert-danger">Usuário não encontrado.</div>
<?php endif; ?>


