<?php

session_start();

if(!isset($_SESSION['usuario']))
{
    header("Location: ../auth/login.php");
    exit();
}

require_once("../../config/conexao.php");

$usuario_id =
$_SESSION['usuario']['id'];

if(isset($_POST['produtos']))
{
    foreach($_POST['produtos']
    as $produto_id)
    {

        $verifica =
        $pdo->prepare("

            SELECT *
            FROM cesta_produtos

            WHERE produto_id = ?
            AND usuario_id = ?

        ");

        $verifica->execute([
            $produto_id,
            $usuario_id
        ]);

        if(!$verifica->fetch())
        {
            $sql = $pdo->prepare("

                INSERT INTO
                cesta_produtos
                (
                    produto_id,
                    usuario_id
                )

                VALUES (?, ?)

            ");

            $sql->execute([
                $produto_id,
                $usuario_id
            ]);
        }
    }
}

$produtos = $pdo->query("
    SELECT *
    FROM produtos
")->fetchAll();

$cesta = $pdo->prepare("

    SELECT
        produtos.*

    FROM cesta_produtos

    INNER JOIN produtos
    ON cesta_produtos.produto_id
    = produtos.id

    WHERE usuario_id = ?

");

$cesta->execute([
    $usuario_id
]);

$itens =
$cesta->fetchAll();

$total = 0;

foreach($itens as $item)
{
    $total +=
    $item['preco'];
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Cesta</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php require_once("../../components/navbar.php"); ?>

<div class="container mt-4">

<h1>Cesta de Compras</h1>

<hr>

<form method="POST">

<h3>Selecione Produtos</h3>

<?php foreach($produtos as $produto): ?>

<div class="form-check">

    <input
        class="form-check-input"
        type="checkbox"
        name="produtos[]"
        value="<?= $produto['id'] ?>"
    >

    <label class="form-check-label">

        <?= $produto['nome'] ?>

        —
        R$
        <?= number_format(
            $produto['preco'],
            2,
            ',',
            '.'
        ) ?>

    </label>

</div>

<?php endforeach; ?>

<button
    class="btn btn-success mt-3"
>
    Adicionar na Cesta
</button>

</form>

<hr>

<h3>Minha Cesta</h3>

<table class="table table-bordered">

<thead>

<tr>
    <th>Produto</th>
    <th>Preço</th>
    <th>Ações</th>
</tr>

</thead>

<tbody>

<?php foreach($itens as $item): ?>

<tr>

<td>
    <?= $item['nome'] ?>
</td>

<td>

R$

<?= number_format(
    $item['preco'],
    2,
    ',',
    '.'
) ?>

</td>

<td>

<a
href="remover.php?produto_id=<?= $item['id'] ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Remover produto da cesta?')"
>
Remover
</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

<div class="alert alert-info">

<strong>
Produtos selecionados:
</strong>

<?= count($itens) ?>

<br>

<strong>
Valor total:
</strong>

R$

<?= number_format(
    $total,
    2,
    ',',
    '.'
) ?>

</div>

<a
href="../../dashboard.php"
class="btn btn-secondary"
>
Voltar
</a>

</div>
</body>
</html>