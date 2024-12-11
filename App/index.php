<?php

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>LOGIN</h1>
    <form action="/" method="POST">
        <label>Usuario:</label>
        <input type="text" name="usuario" required>
        <label>Senha:</label>
        <input type="password" name="senha" required>
    </form>
    <p>Não tem um login? <a href="./View/CadastroUsuario.php">Cadastre aqui</a></p>
    <button type="submit">Entrar</button>
</body>

</html>