<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Usuário</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 20px;">
    <h2>Cadastrar Novo Usuário (Teste 1)</h2>
    
    <?php if(!empty($mensagem)): ?>
        <p><strong><?php echo $mensagem; ?></strong></p>
    <?php endif; ?>

    <?php if($usuarioSalvo): ?>
        <div style="background: #e1f5fe; padding: 15px; margin-bottom: 20px; border-left: 5px solid #0288d1;">
            <h3>Evidência do Teste 1:</h3>
            <p>ID Gerado no Banco: <strong><?php echo $usuarioSalvo->id; ?></strong></p>
            <p>Nome: <?php echo htmlspecialchars($usuarioSalvo->nome); ?></p>
        </div>
    <?php endif; ?>

    <form method="POST">
        <label>Nome: <input type="text" name="nome" required></label><br><br>
        <label>Email: <input type="email" name="email" required></label><br><br>
        <label>Senha: <input type="password" name="senha" required></label><br><br>
        <button type="submit" style="padding: 5px 15px;">Salvar Usuário</button>
    </form>
    <br>
    <a href="buscarUsuario">Ir para a página de Busca / Testes</a>
</body>
</html>
