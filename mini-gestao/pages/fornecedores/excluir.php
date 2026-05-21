<?php

require_once("../../config/conexao.php");

$id = $_GET['id'];

try
{
    $pdo->beginTransaction();

    $sqlProdutos = $pdo->prepare("

        DELETE FROM produtos

        WHERE fornecedor_id = ?

    ");

    $sqlProdutos->execute([$id]);

    $sqlFornecedor = $pdo->prepare("

        DELETE FROM fornecedores

        WHERE id = ?

    ");

    $sqlFornecedor->execute([$id]);

    $pdo->commit();

    header("Location: index.php");
    exit();
}
catch(PDOException $e)
{
    $pdo->rollBack();

    echo "Erro ao excluir.";
}