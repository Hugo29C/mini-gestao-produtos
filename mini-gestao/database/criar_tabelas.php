<?php

require_once("../config/conexao.php");

$sql = "

CREATE TABLE IF NOT EXISTS usuarios (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nome VARCHAR(100),

    email VARCHAR(100) UNIQUE,

    senha VARCHAR(255)

);

CREATE TABLE IF NOT EXISTS fornecedores (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nome VARCHAR(100) NOT NULL,

    email VARCHAR(100),

    telefone VARCHAR(30),

    endereco VARCHAR(255)

);

CREATE TABLE IF NOT EXISTS produtos (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nome VARCHAR(100),

    preco DECIMAL(10,2),

    fornecedor_id INT,

    FOREIGN KEY (fornecedor_id)
    REFERENCES fornecedores(id)

);

CREATE TABLE IF NOT EXISTS cestas (

    id INT AUTO_INCREMENT PRIMARY KEY,

    usuario_id INT,

    FOREIGN KEY (usuario_id)
    REFERENCES usuarios(id)

);

CREATE TABLE IF NOT EXISTS cesta_produtos (

    id INT AUTO_INCREMENT PRIMARY KEY,

    cesta_id INT,

    produto_id INT,

    FOREIGN KEY (cesta_id)
    REFERENCES cestas(id),

    FOREIGN KEY (produto_id)
    REFERENCES produtos(id)

);

";

$pdo->exec($sql);

echo "Tabelas criadas com sucesso!";