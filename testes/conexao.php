<?php

$usuario = 'root';
$senha = '';
$database = 'crud_php';
$host = 'localhost';

$conexao = mysqli_connect($host, $usuario, $senha, $database) or die ('Não foi possível conectar');
if($conexao->error) {
    die("Falha ao conectar ao banco de dados: " . $conexao->error);
}
?>
*