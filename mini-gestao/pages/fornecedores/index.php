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
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    $sql = $pdo->prepare("

        INSERT INTO fornecedores
        (nome, email, telefone, endereco)

        VALUES
        (?, ?, ?, ?)

    ");

    $sql->execute([
        $nome,
        $email,
        $telefone,
        $endereco
    ]);
}

$fornecedores = $pdo->query("
    SELECT *
    FROM fornecedores
")->fetchAll();

?>

<!DOCTYPE html>
<html>

<head>

<title>Fornecedores</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php require_once("../../components/navbar.php"); ?>

<div class="container mt-4">

<h1>Cadastro de Fornecedores</h1>

<hr>

<form id="formFornecedor">

    <input
        type="text"
        id="nome"
        placeholder="Nome do fornecedor"
        class="form-control mb-3"
        required
    >

    <input
        type="email"
        id="email"
        placeholder="Email"
        class="form-control mb-3"
    >

    <input
        type="text"
        id="telefone"
        placeholder="Telefone"
        class="form-control mb-3"
    >

    <input
        type="text"
        id="endereco"
        placeholder="Endereço"
        class="form-control mb-3"
    >

    <button
        type="submit"
        class="btn btn-success"
    >
        Cadastrar Fornecedor
    </button>

</form>

<hr>

<h2>Lista de Fornecedores</h2>

<div id="listaFornecedores">

</div>

<a
    href="../../dashboard.php"
    class="btn btn-secondary"
>
    Voltar
</a>

<script>

carregarFornecedores();

function carregarFornecedores()
{
    fetch("../../ajax/listar_fornecedores.php")
    .then(response => response.text())
    .then(data => {

        document.getElementById(
            "listaFornecedores"
        ).innerHTML = data;

    });
}

document
.getElementById(
    "formFornecedor"
)
.addEventListener(
    "submit",
    function(e)
{

    e.preventDefault();

    let formData =
    new FormData();

    formData.append(
        "nome",
        document.getElementById(
            "nome"
        ).value
    );

    formData.append(
        "email",
        document.getElementById(
            "email"
        ).value
    );

    formData.append(
        "telefone",
        document.getElementById(
            "telefone"
        ).value
    );

    formData.append(
        "endereco",
        document.getElementById(
            "endereco"
        ).value
    );

    fetch(
        "../../ajax/fornecedor.php",
        {
            method: "POST",
            body: formData
        }
    )
    .then(response =>
        response.text()
    )
    .then(data => {

        carregarFornecedores();

        document
        .getElementById(
            "formFornecedor"
        )
        .reset();

    });

});

</script>
</div>
</body>
</html>