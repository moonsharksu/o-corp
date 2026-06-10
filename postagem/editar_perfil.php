<?php

include 'conexao.php';

$perfil = $conexao->query(
    "SELECT * FROM perfil LIMIT 1"
)->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="editar_css.css">
</head>
<body>

<div class="editar-card">

    <h1>Editar Perfil</h1>

    <div class="preview-container">
        <img
            src="uploads/<?= htmlspecialchars($perfil['foto']); ?>"
            class="preview-foto"
            alt="Foto de Perfil">
    </div>

    <form action="salvar_perfil.php" method="POST" enctype="multipart/form-data">

        <label>Nome</label>

        <input
            type="text"
            name="nome"
            value="<?= htmlspecialchars($perfil['nome']); ?>"
            required>

        <label>Bio</label>

        <textarea name="bio"><?= htmlspecialchars($perfil['bio']); ?></textarea>

        <label>Foto de Perfil</label>

        <input
            type="file"
            name="foto"
            accept="image/*">

        <div class="botoes">

            <button type="submit" class="btn-salvar">
                Salvar Alterações
            </button>

            <a href="index.php" class="btn-voltar">
                Voltar
            </a>

        </div>

    </form>

</div>