<?php

include 'conexao.php';

$nome = $_POST['nome'];
$bio = $_POST['bio'];

$foto = '';

if (!empty($_FILES['foto']['name'])) {

    $foto = uniqid() . "_" . $_FILES['foto']['name'];

    move_uploaded_file(
        $_FILES['foto']['tmp_name'],
        "uploads/" . $foto
    );

    $sql = "
        UPDATE perfil
        SET nome=?, bio=?, foto=?
        WHERE id=1
    ";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sss", $nome, $bio, $foto);

} else {

    $sql = "
        UPDATE perfil
        SET nome=?, bio=?
        WHERE id=1
    ";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $nome, $bio);
}

$stmt->execute();

header("Location: index.php");
exit;