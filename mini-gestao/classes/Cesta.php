<?php

class Cesta
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function adicionar(
        $produto_id,
        $usuario_id
    )
    {
        $sql =
        $this->pdo->prepare("

            INSERT INTO
            cesta_produtos
            (
                produto_id,
                usuario_id
            )

            VALUES (?, ?)

        ");

        return $sql->execute([
            $produto_id,
            $usuario_id
        ]);
    }

    public function listar(
        $usuario_id
    )
    {
        $sql =
        $this->pdo->prepare("

            SELECT
                produtos.*

            FROM cesta_produtos

            INNER JOIN produtos

            ON
            cesta_produtos.produto_id
            = produtos.id

            WHERE usuario_id = ?

        ");

        $sql->execute([
            $usuario_id
        ]);

        return $sql->fetchAll();
    }
}