<?php

require_once("../config/conexao.php");
require_once("../classes/Fornecedor.php");

$fornecedor =
new Fornecedor($pdo);

$fornecedor->cadastrar(

    $_POST['nome'],
    $_POST['email'],
    $_POST['telefone'],
    $_POST['endereco']

);

echo "ok";