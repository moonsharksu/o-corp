<?php

session_start();

include 'conexao.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email = ?";

$stmt = $conexao->prepare($sql);

$stmt->bind_param("s", $email);

$stmt->execute();

$resultado = $stmt->get_result();

if($resultado->num_rows == 1){

    $usuario = $resultado->fetch_assoc();

    if(password_verify($senha, $usuario['senha'])){

        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];

        header("Location: index.php");
        exit;
    }
}

echo "
<h2 style='color:red;text-align:center;margin-top:50px;'>
Login inválido
</h2>
";