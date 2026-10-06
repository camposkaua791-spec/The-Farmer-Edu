<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Buscar Usuário</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 20px;">
    <h2>Buscar Usuário (Teste 2)</h2>
    <form method="GET">
        <label>Digite o Email Cadastrado: <input type="text" name="email" required></label>
        <button type="submit" style="padding: 3px 10px;">Buscar</button>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['email'])): ?>
        <h3>Resultado do Teste 2:</h3>
        <?php if ($resultadoBusca): ?>
            <p style="color: green; font-weight: bold;">✅ Usuário Encontrado com Sucesso!</p>
            <ul>
                <li>ID: <?php echo $resultadoBusca->id; ?></li>
                <li>Nome: <?php echo htmlspecialchars($resultadoBusca->nome); ?></li>
                <li>Email: <?php echo htmlspecialchars($resultadoBusca->email); ?></li>
            </ul>
        <?php else: ?>
            <p style="color: red; font-weight: bold;">❌ Nenhum usuário encontrado para este email.</p>
        <?php endif; ?>
    <?php endif; ?>

    <hr style="margin: 30px 0;">

    <h2>Simulação de Ataque Controlado (Teste 3)</h2>
    <p>Executando nos bastidores: <code>Usuario::buscarPorEmail($pdo, "' OR '1'='1");</code></p>
    
    <div style="padding: 10px; background-color: #f5f5f5; border: 1px solid #ccc; font-family: monospace;">
        <strong>Resultado do Retorno:</strong> 
        <pre><?php var_dump($ataqueSql); ?></pre>
    </div>

    <?php if ($ataqueSql === null): ?>
        <p style="color: green; font-weight: bold; font-size: 16px;">✅ SUCESSO: O retorno foi NULL. O sistema está protegido contra SQL Injection através de Prepared Statements!</p>
    <?php else: ?>
        <p style="color: red; font-weight: bold; font-size: 16px;">🚨 FALHA: O ataque retornou dados! Verifique se há concatenação de variáveis no seu SQL.</p>
    <?php endif; ?>
    <br>
    <a href="novoUsuario">Voltar para o Cadastro</a>
</body>
</html>
