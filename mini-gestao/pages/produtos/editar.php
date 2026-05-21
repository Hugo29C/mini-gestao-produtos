<?php

require_once("../../config/conexao.php");

$id = $_GET['id'];

$sql = $pdo->prepare("
    SELECT *
    FROM produtos
    WHERE id = ?
");

$sql->execute([$id]);

$produto = $sql->fetch();

$fornecedores = $pdo->query("
    SELECT *
    FROM fornecedores
")->fetchAll();

if($_POST)
{
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $fornecedor_id = $_POST['fornecedor_id'];

    $sql = $pdo->prepare("

        UPDATE produtos

        SET
        nome = ?,
        preco = ?,
        fornecedor_id = ?

        WHERE id = ?

    ");

    $sql->execute([
        $nome,
        $preco,
        $fornecedor_id,
        $id
    ]);

    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Editar Produto</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-5">

<h1>Editar Produto</h1>

<form method="POST">

<input
    type="text"
    name="nome"
    class="form-control mb-3"
    value="<?= $produto['nome'] ?>"
>

<input
    type="number"
    step="0.01"
    name="preco"
    class="form-control mb-3"
    value="<?= $produto['preco'] ?>"
>

<select
    name="fornecedor_id"
    class="form-control mb-3"
>

<?php foreach($fornecedores as $fornecedor): ?>

<option
value="<?= $fornecedor['id'] ?>"

<?= $produto['fornecedor_id']
== $fornecedor['id']
? 'selected' : '' ?>

>

<?= $fornecedor['nome'] ?>

</option>

<?php endforeach; ?>

</select>

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