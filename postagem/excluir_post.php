<?php

include 'conexao.php';

if(isset($_GET['id'])){

    $id = intval($_GET['id']);

    // PEGA A IMAGEM
    $sql = "SELECT imagem FROM posts WHERE id = $id";

    $resultado = $conexao->query($sql);

    if($resultado->num_rows > 0){

        $post = $resultado->fetch_assoc();

        // REMOVE IMAGEM
        if(!empty($post['imagem'])){

            $arquivo = "uploads/" . $post['imagem'];

            if(file_exists($arquivo)){
                unlink($arquivo);
            }
        }

        // REMOVE POST
        $delete = "DELETE FROM posts WHERE id = $id";

        if($conexao->query($delete)){
            header("Location: index.php");
            exit;
        } else {
            echo "Erro ao excluir.";
        }
    }
}   
?>