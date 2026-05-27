<?php
// Configuração do banco de dados
$host = "localhost";
$dbname = "meu_programa";
$username = "root";
$password = "";

// Conexão com o banco de dados
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

// Função para criar um usuário
function criarUsuario($nome, $email, $senha) {
    global $pdo;
    $hashSenha = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nome' => $nome, 'email' => $email, 'senha' => $hashSenha]);
    return $pdo->lastInsertId();
}

// Função para ler usuários
function lerUsuarios() {
    global $pdo;
    $sql = "SELECT * FROM usuarios";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Função para atualizar um usuário
function atualizarUsuario($id, $nome, $email) {
    global $pdo;
    $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute(['nome' => $nome, 'email' => $email, 'id' => $id]);
}

// Função para excluir um usuário
function excluirUsuario($id) {
    global $pdo;
    $sql = "DELETE FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute(['id' => $id]);
}

// Exemplo de uso
// Criar um novo usuário
$novoUsuarioId = criarUsuario("João Silva", "joao@example.com", "senha123");

// Ler todos os usuários
$usuarios = lerUsuarios();
foreach ($usuarios as $usuario) {
    echo "ID: {$usuario['id']}, Nome: {$usuario['nome']}, Email: {$usuario['email']}<br>";
}

// Atualizar um usuário
atualizarUsuario($novoUsuarioId, "João Pedro", "joaopedro@example.com");

// Excluir um usuário
excluirUsuario($novoUsuarioId);
?>