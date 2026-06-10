<?php

include 'conexao.php';

$nome = $_POST['nome'];
$email = $_POST['email'];

$senha = password_hash(
    $_POST['senha'],
    PASSWORD_DEFAULT
);

$sql = "
INSERT INTO usuarios
(nome,email,senha)
VALUES
(?,?,?)
";

$stmt = $conexao->prepare($sql);

$stmt->bind_param(
    "sss",
    $nome,
    $email,
    $senha
);

$stmt->execute();

header("Location: login.php");
exit;