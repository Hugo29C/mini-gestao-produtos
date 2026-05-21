<?php

session_start();

if(!isset($_SESSION['usuario']))
{
    header("Location: ../auth/login.php");
    exit();
}

require_once("../../config/conexao.php");

if($_POST)
{
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $fornecedor_id = $_POST['fornecedor_id'];

    $sql = $pdo->prepare("

        INSERT INTO produtos
        (nome, preco, fornecedor_id)

        VALUES
        (?, ?, ?)

    ");

    $sql->execute([
        $nome,
        $preco,
        $fornecedor_id
    ]);
}

$fornecedores = $pdo->query("
    SELECT *
    FROM fornecedores
")->fetchAll();

$produtos = $pdo->query("

    SELECT
        produtos.*,
        fornecedores.nome AS fornecedor

    FROM produtos

    INNER JOIN fornecedores
    ON produtos.fornecedor_id =
    fornecedores.id

")->fetchAll();

?>

<!DOCTYPE html>
<html>

<head>

<title>Produtos</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php require_once("../../components/navbar.php"); ?>

<div class="container mt-4">

<h1>Cadastro de Produtos</h1>

<hr>

<form method="POST">

    <input
        type="text"
        name="nome"
        placeholder="Nome do produto"
        class="form-control mb-3"
        required
    >

    <input
        type="number"
        step="0.01"
        name="preco"
        placeholder="Preço"
        class="form-control mb-3"
        required
    >

    <select
        name="fornecedor_id"
        class="form-control mb-3"
        required
    >

        <option value="">
            Selecione um fornecedor
        </option>

        <?php foreach($fornecedores as $fornecedor): ?>

            <option value="<?= $fornecedor['id'] ?>">

                <?= $fornecedor['nome'] ?>

            </option>

        <?php endforeach; ?>

    </select>

    <button class="btn btn-success">
        Cadastrar Produto
    </button>

</form>

<hr>

<h2>Lista de Produtos</h2>

<table class="table table-bordered">

<thead>

<tr>

    <th>ID</th>
    <th>Nome</th>
    <th>Preço</th>
    <th>Fornecedor</th>
    <th>Ações</th>

</tr>

</thead>

<tbody>

<?php foreach($produtos as $produto): ?>

<tr>

    <td>
        <?= $produto['id'] ?>
    </td>

    <td>
        <?= $produto['nome'] ?>
    </td>

    <td>
        R$ <?= $produto['preco'] ?>
    </td>

    <td>
        <?= $produto['fornecedor'] ?>
    </td>

    <td>

        <a
            href="editar.php?id=<?= $produto['id'] ?>"
            class="btn btn-warning btn-sm"
        >
            Editar
        </a>

        <a
            href="excluir.php?id=<?= $produto['id'] ?>"
            class="btn btn-danger btn-sm"
            onclick="return confirm('Deseja excluir?')"
        >
            Excluir
        </a>

    </td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

<a
    href="../../dashboard.php"
    class="btn btn-secondary"
>
    Voltar
</a>

</div>
</body>
</html>