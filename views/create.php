<?php include 'header.php'; ?>

<h2 class="mb-4">Cadastrar Novo Usuário</h2>
<form action="index.php?action=create" method="POST">
    <div class="form-group">
        <label>Nome:</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="form-group">
        <label>CPF:</label>
        <input type="text" name="cpf" class="form-control" required>
    </div>
    <div class="form-group">
        <label>E-mail:</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Data de Nascimento:</label>
        <input type="date" name="data_nascimento" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Telefone:</label>
        <input type="text" name="telefone" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Senha:</label>
        <input type="password" name="senha" class="form-control" required>
    </div>
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <button type="submit" class="btn btn-primary">Cadastrar</button>
    <a href="index.php?action=list" class="btn btn-secondary">Voltar</a> <!-- Botão Voltar -->
</form>

<?php include 'footer.php'; ?>
