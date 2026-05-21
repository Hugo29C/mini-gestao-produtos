<?php

class Produto
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function cadastrar(
        $nome,
        $preco,
        $fornecedor_id
    )
    {
        $sql = $this->pdo->prepare("

            INSERT INTO produtos
            (
                nome,
                preco,
                fornecedor_id
            )

            VALUES (?, ?, ?)

        ");

        return $sql->execute([
            $nome,
            $preco,
            $fornecedor_id
        ]);
    }

    public function listar()
    {
        return $this->pdo->query("

            SELECT
                produtos.*,
                fornecedores.nome
                AS fornecedor

            FROM produtos

            INNER JOIN fornecedores
            ON produtos.fornecedor_id =
            fornecedores.id

        ")->fetchAll();
    }

    public function excluir($id)
    {
        $sql = $this->pdo->prepare("

            DELETE FROM produtos

            WHERE id = ?

        ");

        return $sql->execute([$id]);
    }
}