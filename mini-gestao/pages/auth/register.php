<?php

require_once("../../config/conexao.php");

if($_POST)
{
    $nome = $_POST['nome'];

    $email = $_POST['email'];

    $senha = hash(
        'sha256',
        $_POST['senha']
    );

    $sql = $pdo->prepare("

        INSERT INTO usuarios
        (nome, email, senha)

        VALUES
        (?, ?, ?)

    ");

    $sql->execute([
        $nome,
        $email,
        $senha
    ]);

    echo "
        <div class='alert alert-success'>
            Usuário cadastrado!
        </div>
    ";
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Cadastro</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-5">

<h1>Cadastro</h1>

<form method="POST">

    <input
        type="text"
        name="nome"
        placeholder="Nome"
        class="form-control mb-3"
    >

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

    <button class="btn btn-primary">
        Cadastrar
    </button>

</form>

</body>
</html>