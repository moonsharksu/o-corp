<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $titulo = trim($_POST['titulo']);
    $conteudo = trim($_POST['conteudo']);

    // Array para armazenar até 4 imagens
    $imagens = ["", "", "", ""];

    // Cria a pasta uploads se não existir
    if (!is_dir("uploads")) {
        mkdir("uploads", 0777, true);
    }

    // Verifica se foram enviadas imagens
    if (isset($_FILES['imagens'])) {

        $totalArquivos = count($_FILES['imagens']['name']);

        // Limita a 4 imagens
        $totalArquivos = min($totalArquivos, 4);

        for ($i = 0; $i < $totalArquivos; $i++) {

            if ($_FILES['imagens']['error'][$i] === 0) {

                $nomeOriginal = $_FILES['imagens']['name'][$i];

                $extensao = strtolower(
                    pathinfo($nomeOriginal, PATHINFO_EXTENSION)
                );

                // Extensões permitidas
                $permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                if (in_array($extensao, $permitidas)) {

                    $novoNome = uniqid('img_', true) . "." . $extensao;

                    $destino = "uploads/" . $novoNome;

                    if (
                        move_uploaded_file(
                            $_FILES['imagens']['tmp_name'][$i],
                            $destino
                        )
                    ) {
                        $imagens[$i] = $novoNome;
                    }
                }
            }
        }
    }

    $sql = "
        INSERT INTO posts
        (
            titulo,
            conteudo,
            imagem,
            imagem2,
            imagem3,
            imagem4
        )
        VALUES
        (
            ?, ?, ?, ?, ?, ?
        )
    ";

    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die("Erro SQL: " . $conexao->error);
    }

    $stmt->bind_param(
        "ssssss",
        $titulo,
        $conteudo,
        $imagens[0],
        $imagens[1],
        $imagens[2],
        $imagens[3]
    );

    if ($stmt->execute()) {

        header("Location: index.php");
        exit;

    } else {

        echo "Erro ao salvar: " . $stmt->error;

    }

    $stmt->close();
}

$conexao->close();

?>