<?php
require_once '../init.php';

$PDO = db_connect();
$sql = "SELECT idCliente, nomeCliente, telefone, endereco FROM Cliente ORDER BY nomeCliente ASC";
$stmt = $PDO->prepare($sql);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Lista de Clientes</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/estilo.css">

</head>
<body>
  <div class="container">
    <h2>Clientes Cadastrados</h2>
    <a href="formAddCliente.html" class="btn btn-success mb-3">Novo Cliente</a>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Telefone</th>
          <th>Endereço</th>
          <th colspan="2">Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($cliente = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
          <td><?= $cliente['idCliente'] ?></td>
          <td><?= $cliente['nomeCliente'] ?></td>
          <td><?= $cliente['telefone'] ?></td>
          <td><?= $cliente['endereco'] ?></td>
          <td><a href="formEditCliente.php?id=<?= $cliente['idCliente'] ?>" class="btn btn-primary">Editar</a></td>
          <td><a href="deleteCliente.php?id=<?= $cliente['idCliente'] ?>" class="btn btn-danger" onclick="return confirm('Deseja realmente remover?');">Remover</a></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <a href="../index.html" class="btn btn-secondary">Voltar</a>
  </div>
</body>
</html>
