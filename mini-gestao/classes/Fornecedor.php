<?php

class Fornecedor
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function cadastrar(
        $nome,
        $email,
        $telefone,
        $endereco
    )
    {
        $sql = $this->pdo->prepare("

            INSERT INTO fornecedores
            (
                nome,
                email,
                telefone,
                endereco
            )

            VALUES (?, ?, ?, ?)

        ");

        return $sql->execute([
            $nome,
            $email,
            $telefone,
            $endereco
        ]);
    }

    public function listar()
    {
        return $this->pdo->query("
            SELECT *
            FROM fornecedores
        ")->fetchAll();
    }

    public function excluir($id)
    {
        $sql = $this->pdo->prepare("
            DELETE FROM fornecedores
            WHERE id = ?
        ");

        return $sql->execute([$id]);
    }
}