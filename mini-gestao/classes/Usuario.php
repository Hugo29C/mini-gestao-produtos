<?php

class Usuario
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function cadastrar(
        $nome,
        $email,
        $senha
    )
    {
        $senha =
        hash(
            'sha256',
            $senha
        );

        $sql =
        $this->pdo->prepare("

            INSERT INTO usuarios
            (
                nome,
                email,
                senha
            )

            VALUES (?, ?, ?)

        ");

        return $sql->execute([
            $nome,
            $email,
            $senha
        ]);
    }

    public function login(
        $email,
        $senha
    )
    {
        $senha =
        hash(
            'sha256',
            $senha
        );

        $sql =
        $this->pdo->prepare("

            SELECT *

            FROM usuarios

            WHERE email = ?
            AND senha = ?

        ");

        $sql->execute([
            $email,
            $senha
        ]);

        return $sql->fetch();
    }
}