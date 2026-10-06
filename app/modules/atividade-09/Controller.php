<?php
require_once __DIR__ . '/Model.php';

class UsuarioController {
    
    public function showNovoUsuario() {
        $mensagem = "";
        $usuarioSalvo = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pdo = conectar(); 
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            if ($nome && $email && $senha) {
                $usuario = new Usuario($nome, $email, $senha);
                if ($usuario->salvar($pdo)) {
                    $mensagem = "✅ Usuário salvo com sucesso!";
                    $usuarioSalvo = $usuario;
                } else {
                    $mensagem = "❌ Erro ao salvar usuário.";
                }
            }
        }
        require_once __DIR__ . '/views/novoUsuario.php';
    }

    public function showBuscarUsuario() {
        $pdo = conectar(); 
        $resultadoBusca = null;
        $termoBuscado = $_GET['email'] ?? null;

        if ($termoBuscado !== null) {
            $resultadoBusca = Usuario::buscarPorEmail($pdo, $termoBuscado);
        }

        
        $ataqueSql = Usuario::buscarPorEmail($pdo, "' OR '1'='1");

        require_once __DIR__ . '/views/buscarUsuario.php';
    }
}
