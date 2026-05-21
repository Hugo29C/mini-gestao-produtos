<?php

session_start();

require_once("components/navbar.php");

if(!isset($_SESSION['usuario']))
{
    header("Location: pages/auth/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-5">

    <?php require_once("components/navbar.php"); ?>

    <h1>
        Bem-vindo,
        <?php echo $_SESSION['usuario']['nome']; ?>
    </h1>

    <hr>

    <h3>Menu do Sistema</h3>

    <div class="mt-4">

        <a
            href="pages/produtos/index.php"
            class="btn btn-primary"
        >
            Produtos
        </a>

        <a
            href="pages/fornecedores/index.php"
            class="btn btn-success"
        >
            Fornecedores
        </a>

        <a
            href="pages/cesta/index.php"
            class="btn btn-warning"
        >
            Cesta
        </a>

        <a
            href="logout.php"
            class="btn btn-danger"
        >
            Sair
        </a>

    </div>

</body>
</html>