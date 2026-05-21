<?php

require_once("../config/conexao.php");
require_once("../classes/Fornecedor.php");

$fornecedor =
new Fornecedor($pdo);

$fornecedores =
$fornecedor->listar();

?>

<table class="table table-bordered">

<thead>

<tr>

<th>ID</th>
<th>Nome</th>
<th>Email</th>
<th>Telefone</th>
<th>Endereço</th>
<th>Ações</th>

</tr>

</thead>

<tbody>

<?php foreach($fornecedores as $fornecedor): ?>

<tr>

<td>
<?= $fornecedor['id'] ?>
</td>

<td>
<?= $fornecedor['nome'] ?>
</td>

<td>
<?= $fornecedor['email'] ?>
</td>

<td>
<?= $fornecedor['telefone'] ?>
</td>

<td>
<?= $fornecedor['endereco'] ?>
</td>

<td>

<a
href="../fornecedores/editar.php?id=<?= $fornecedor['id'] ?>"
class="btn btn-warning btn-sm"
>
Editar
</a>

<a
href="../fornecedores/excluir.php?id=<?= $fornecedor['id'] ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Se você excluir este fornecedor, todos os produtos dele também serão excluídos.\n\nDeseja continuar?')"
>
Excluir
</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>