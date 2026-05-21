<?php

session_start();

require_once("../../config/conexao.php");

$produto_id = $_GET['produto_id'];

$usuario_id =
$_SESSION['usuario']['id'];

$sql = $pdo->prepare("

    DELETE FROM cesta_produtos

    WHERE produto_id = ?
    AND usuario_id = ?

");

$sql->execute([
    $produto_id,
    $usuario_id
]);

header("Location: index.php");
exit();