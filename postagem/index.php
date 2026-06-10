
<?php
session_start();

if(!isset($_SESSION['usuario_id'])){

    header("Location: login.php");
    exit;
}


error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conexao.php';
$perfil = $conexao->query("SELECT * FROM perfil LIMIT 1")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Postagem</title>

    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">

            <a class="navbar-brand" href="index.php">
                <h2>O<em>Corp</em></h2>
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarResponsive">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">

                <ul class="navbar-nav ml-auto">

                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Início</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Explore</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Contate-nos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log out</a>
                    </li>

                </ul>

            </div>

        </div>
    </nav>
</header>

<div class="container">
<div class="perfil-card">

    <a href="editar_perfil.php" class="btn-editar-perfil">
        ✏ Editar Perfil
    </a>

    <div class="perfil-topo">

        <img
            src="uploads/<?= htmlspecialchars($perfil['foto']); ?>"
            class="foto-perfil"
            alt="Perfil">

        <div class="perfil-info">

            <h2>
                <?= htmlspecialchars($perfil['nome']); ?>
            </h2>

            <p class="bio">
                <?= nl2br(htmlspecialchars($perfil['bio'])); ?>
            </p>

            <div class="perfil-stats">

                <div>
                    <strong>
                        <?php
                        $r = $conexao->query("SELECT COUNT(*) total FROM posts");
                        echo $r->fetch_assoc()['total'];
                        ?>
                    </strong>
                    <span>Posts</span>
                </div>

            </div>

        </div>

    </div>

</div>

    <form
        action="salvar_post.php"
        method="POST"
        enctype="multipart/form-data"
        class="form-post">

        <input
            type="text"
            name="titulo"
            placeholder="Título do post"
            required>

        <textarea
            name="conteudo"
            placeholder="Digite o conteúdo..."
            required></textarea>

        <input
            type="file"
            name="imagens[]"
            accept="image/*"
            multiple>

        <button type="submit">
            Publicar
        </button>

    </form>

    <div class="posts">

        <h2>Postagens</h2>

        <?php

        $sql = "SELECT * FROM posts ORDER BY id DESC";
        $resultado = $conexao->query($sql);

        if ($resultado && $resultado->num_rows > 0):

            while ($post = $resultado->fetch_assoc()):

        ?>

        <div class="post">

            <h3>
                <?= htmlspecialchars($post['titulo']); ?>
            </h3>

            <div class="galeria">

                <?php

                $imagens = [
                    $post['imagem'] ?? '',
                    $post['imagem2'] ?? '',
                    $post['imagem3'] ?? '',
                    $post['imagem4'] ?? ''
                ];

                foreach ($imagens as $img):

                    if (!empty($img)):
                ?>

                    <img
                        src="uploads/<?= htmlspecialchars($img); ?>"
                        class="post-img"
                        alt="Imagem da postagem"
                        onclick="abrirImagem(this.src)">

                <?php
                    endif;

                endforeach;
                ?>

            </div>

            <p>
                <?= nl2br(htmlspecialchars($post['conteudo'])); ?>
            </p>

            <small>
                Publicado em:
                <?= $post['data_postagem']; ?>
            </small>

            <br><br>

            <a
                href="excluir_post.php?id=<?= $post['id']; ?>"
                class="btn-excluir"
                onclick="return confirm('Deseja excluir esta postagem?')">

                Excluir

            </a>

        </div>

        <?php

            endwhile;

        else:

            echo "<p>Nenhuma postagem encontrada.</p>";

        endif;

        ?>

    </div>

</div>

<!-- Modal de Imagem -->

<div id="modalImagem" class="modal-imagem" onclick="fecharImagem()">

    <button class="seta esquerda" onclick="imagemAnterior(event)">
        ❮
    </button>

    <img id="imagemAmpliada" src="" alt="Imagem ampliada">

    <button class="seta direita" onclick="proximaImagem(event)">
        ❯
    </button>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>

let imagensGaleria = [];
let imagemAtual = 0;

function abrirImagem(src) {

    imagensGaleria = [];

    document.querySelectorAll('.post-img').forEach(function(img) {
        imagensGaleria.push(img.src);
    });

    imagemAtual = imagensGaleria.indexOf(src);

    document.getElementById('imagemAmpliada').src = src;
    document.getElementById('modalImagem').style.display = 'flex';
}

function fecharImagem() {

    document.getElementById('modalImagem').style.display = 'none';
}

function imagemAnterior(event) {

    event.stopPropagation();

    imagemAtual--;

    if (imagemAtual < 0) {
        imagemAtual = imagensGaleria.length - 1;
    }

    document.getElementById('imagemAmpliada').src =
        imagensGaleria[imagemAtual];
}

function proximaImagem(event) {

    event.stopPropagation();

    imagemAtual++;

    if (imagemAtual >= imagensGaleria.length) {
        imagemAtual = 0;
    }

    document.getElementById('imagemAmpliada').src =
        imagensGaleria[imagemAtual];
}

</script>

</body>
</html>