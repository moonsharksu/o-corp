<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href="login.css">
</head>

<body>

<div class="auth-card">

    <h1>Entrar</h1>

    <form action="verificar_login.php" method="POST">

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
            Entrar
        </button>

    </form>

    <p>
        Não possui conta?
        <a href="cadastro.php">
            Cadastre-se
        </a>
    </p>

</div>

</body>
</html>