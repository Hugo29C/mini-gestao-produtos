<?php

require_once("../../config/conexao.php");

$id = $_GET['id'];

$sql = $pdo->prepare("
    SELECT *
    FROM fornecedores
    WHERE id = ?
");

$sql->execute([$id]);

$fornecedor = $sql->fetch();

if($_POST)
{
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    $sql = $pdo->prepare("

        UPDATE fornecedores

        SET
        nome = ?,
        email = ?,
        telefone = ?,
        endereco = ?

        WHERE id = ?

    ");

    $sql->execute([
        $nome,
        $email,
        $telefone,
        $endereco,
        $id
    ]);

    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Editar Fornecedor</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-5">

<h1>Editar Fornecedor</h1>

<form method="POST">

    <input
        type="text"
        name="nome"
        class="form-control mb-3"
        value="<?= $fornecedor['nome'] ?>"
        required
    >

    <input
        type="email"
        name="email"
        class="form-control mb-3"
        value="<?= $fornecedor['email'] ?>"
    >

    <input
        type="text"
        name="telefone"
        class="form-control mb-3"
        value="<?= $fornecedor['telefone'] ?>"
    >

    <input
        type="text"
        name="endereco"
        class="form-control mb-3"
        value="<?= $fornecedor['endereco'] ?>"
    >

    <button class="btn btn-primary">
        Salvar Alterações
    </button>

    <a
        href="index.php"
        class="btn btn-secondary"
    >
        Voltar
    </a>

</form>

</body>
</html>