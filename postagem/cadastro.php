<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="cadastro.css">
</head>
<body>

<div class="auth-card">

    <h1>Criar Conta</h1>

    <form action="salvar_cadastro.php" method="POST">

        <input
            type="text"
            name="nome"
            placeholder="Nome"
            required>

        <input
            type="email"
            name="email"
            placeholder="E-mail"
            required>

        <input
            type="password"
            name="senha"
            placeholder="Senha"
            required>

        <button type="submit">
            Cadastrar
        </button>

    </form>

    <p>
        Já possui conta?
        <a href="login.php">Entrar</a>
    </p>

</div>

</body>
</html>