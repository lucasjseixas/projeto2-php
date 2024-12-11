<?php

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>

<body>
    <h1>Cadastro</h1>
    <form action="../Controller/UsuarioController.php" method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" required>
        <label>E-mail:</label>
        <input type="email" name="email" required>
        <label>Senha:</label>
        <input type="password" name="senha" required>
        <input type="hidden" name="action" value="cadastrar">
        <button type="submit">Cadastrar</button>
    </form>
</body>

</html>