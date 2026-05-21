# Mini Sistema de Gestão de Produtos

## Descrição do Projeto

Este projeto consiste em um mini sistema de gestão de produtos desenvolvido em PHP, MySQL, HTML, CSS, JavaScript e Bootstrap.

O sistema permite:

- Cadastro e autenticação de usuários
- Cadastro de fornecedores
- Cadastro de produtos
- Relacionamento entre produtos e fornecedores
- Criação de cesta de compras
- Seleção de produtos via checkbox
- Resumo da cesta (valor total e quantidade de produtos)
- Atualização dinâmica utilizando AJAX

As senhas dos usuários são armazenadas utilizando hash SHA256.

---

## Tecnologias Utilizadas

- PHP
- MySQL
- PDO
- HTML5
- CSS3
- JavaScript
- AJAX
- Bootstrap 5
- MySQL Workbench

---

## Funcionalidades do Sistema

### Autenticação

- Cadastro de usuários
- Login de usuários
- Senha protegida com SHA256

### Fornecedores

- Cadastrar fornecedor
- Editar fornecedor
- Excluir fornecedor
- Exclusão automática dos produtos relacionados

### Produtos

- Cadastro de produtos
- Relacionamento com fornecedor
- Exclusão de produtos

### Cesta

- Seleção de produtos com checkbox
- Adicionar à cesta
- Remover produto da cesta
- Exibir quantidade total
- Exibir valor total da compra

### AJAX

O sistema utiliza AJAX para atualização dinâmica dos dados sem recarregar a página.

---

## Banco de Dados (DER)

### Diagrama Entidade Relacionamento

![DER](docs/DER.png)

---

## Estrutura do Projeto

```txt
mini-gestao/
│── assets/
│── ajax/
│── classes/
│── config/
│── database/
│── pages/
│── components/
│── docs/
│── README.md
```

---

## Como Executar o Projeto

1. Iniciar Apache e MySQL no XAMPP

2. Colocar o projeto dentro da pasta:

```txt
htdocs/
```

3. Criar banco de dados:

```txt
mini_gestao
```

4. Executar:

```txt
database/criar_tabelas.php
```

5. Abrir no navegador:

```txt
http://localhost/mini-gestao
```

---

## Integrantes do Grupo

Nome: Hugo César Dias  
RA: 60001171

Nome: Otávio Marinovski Boyko  
RA: 60300526