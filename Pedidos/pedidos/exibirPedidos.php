<?php
require_once '../init.php';



$PDO = db_connect();

$sql = "SELECT 
          P.idPedido, 
          C.nomeCliente, 
          P.FormaPagamento, 
          P.Valor, 
          P.DataPedido,
          GROUP_CONCAT(Prod.NomeProduto SEPARATOR ', ') AS Produtos
        FROM Pedidos P
        JOIN Cliente C ON P.idCliente = C.idCliente
        LEFT JOIN PedidosProdutos PP ON P.idPedido = PP.idPedido
        LEFT JOIN Produtos Prod ON PP.idProduto = Prod.idProduto
        GROUP BY P.idPedido
        ORDER BY P.idPedido DESC";

$stmt = $PDO->prepare($sql);
$stmt->execute();
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Pedidos Cadastrados</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/estilo.css">

</head>
<body>
  <div class="container">
    <h2>Pedidos Cadastrados</h2>
    <a href="formAddPedido.php" class="btn btn-success mb-3">Novo Pedido</a>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Cliente</th>
          <th>Produtos</th>
          <th>Forma Pagamento</th>
          <th>Valor</th>
          <th>Data</th>
          <th>Hora</th>
          <th colspan="2">Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pedidos as $pedido): ?>
        <tr>
          <td><?= $pedido['idPedido'] ?></td>
          <td><?= htmlspecialchars($pedido['nomeCliente']) ?></td>
          <td><?= htmlspecialchars($pedido['Produtos']) ?></td>
          <td><?= htmlspecialchars($pedido['FormaPagamento']) ?></td>
          <td><?= number_format($pedido['Valor'], 2, ',', '.') ?></td>
          <td><?= converteData($pedido['DataPedido']) ?></td>
          <td><?= converteHora($pedido['DataPedido']) ?></td>
          <td><a href="formEditPedido.php?id=<?= $pedido['idPedido'] ?>" class="btn btn-primary">Editar</a></td>
          <td><a href="deletePedido.php?id=<?= $pedido['idPedido'] ?>" class="btn btn-danger" onclick="return confirm('Deseja realmente remover?');">Remover</a></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <a href="../index.html" class="btn btn-secondary">Voltar</a>
  </div>
</body>
</html>
