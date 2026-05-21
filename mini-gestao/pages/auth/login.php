<?php

session_start();

require_once("../../config/conexao.php");

if($_POST)
{
    $email = $_POST['email'];

    $senha = hash(
        'sha256',
        $_POST['senha']
    );

    $sql = $pdo->prepare("

        SELECT *
        FROM usuarios

        WHERE email = ?
        AND senha = ?

    ");

    $sql->execute([
        $email,
        $senha
    ]);

    $usuario = $sql->fetch();

    if($usuario)
    {
        $_SESSION['usuario'] = $usuario;

        header("Location: ../../dashboard.php");
    }
    else
    {
        echo "
            <div class='alert alert-danger'>
                Login inválido
            </div>
        ";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-5">

<h1>Login</h1>

<form method="POST">

    <input
        type="email"
        name="email"
        placeholder="Email"
        class="form-control mb-3"
    >

    <input
        type="password"
        name="senha"
        placeholder="Senha"
        class="form-control mb-3"
    >

    <button class="btn btn-success">
        Entrar
    </button>

</form>

</body>
</html>