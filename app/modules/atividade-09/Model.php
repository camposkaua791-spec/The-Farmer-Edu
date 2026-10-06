<?php

class Usuario {
    public ?int $id = null;
    public string $nome;
    public string $email;
    public string $senha;

    public function __construct(string $nome = '', string $email = '', string $senha = '', ?int $id = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }

    
    public function salvar(PDO $pdo): bool {
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':senha', $this->senha);

        if ($stmt->execute()) {
            $this->id = (int)$pdo->lastInsertId();
            return true;
        }
        return false;
    }

    
    public static function buscarPorEmail(PDO $pdo, string $email): ?Usuario {
        $sql = "SELECT id, nome, email, senha FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dados) {
            return new Usuario(
                $dados['nome'],
                $dados['email'],
                $dados['senha'],
                (int)$dados['id']
            );
        }

        return null;
    }

    
    public function excluir(PDO $pdo): bool {
        if ($this->id === null) return false;

        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
}
