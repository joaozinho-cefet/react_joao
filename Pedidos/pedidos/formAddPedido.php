<?php
require_once '../init.php';

$PDO = db_connect();

// Buscar clientes para o select
$sqlClientes = "SELECT idCliente, nomeCliente FROM Cliente ORDER BY nomeCliente";
$stmtClientes = $PDO->prepare($sqlClientes);
$stmtClientes->execute();
$clientes = $stmtClientes->fetchAll(PDO::FETCH_ASSOC);

// Buscar produtos para checkbox
$sqlProdutos = "SELECT idProduto, NomeProduto FROM Produtos ORDER BY NomeProduto";
$stmtProdutos = $PDO->prepare($sqlProdutos);
$stmtProdutos->execute();
$produtos = $stmtProdutos->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Novo Pedido</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/estilo.css">

</head>
<body>
  <div class="container">
    <h2>Novo Pedido</h2>
    <form action="addPedido.php" method="post">
      <div class="mb-3">
        <label for="cliente" class="form-label">Cliente</label>
        <select name="idCliente" id="cliente" class="form-select" required>
          <option value="">Selecione um cliente</option>
          <?php foreach ($clientes as $cliente): ?>
            <option value="<?= $cliente['idCliente'] ?>"><?= htmlspecialchars($cliente['nomeCliente']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Produtos</label><br/>
        <?php foreach ($produtos as $produto): ?>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="produtos[]" id="produto<?= $produto['idProduto'] ?>" value="<?= $produto['idProduto'] ?>" />
            <label class="form-check-label" for="produto<?= $produto['idProduto'] ?>">
              <?= htmlspecialchars($produto['NomeProduto']) ?>
            </label>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="mb-3">
        <label for="FormaPagamento" class="form-label">Forma de Pagamento:</label>
        <select name="FormaPagamento" id="FormaPagamento" class="form-select" required>
         <option value="">-- Escolha uma opção --</option>
         <option value="Pix">Pix</option>
         <option value="Dinheiro">Dinheiro</option>
         <option value="Cartao">Cartão</option>
     </select>
    </div>

      <div class="mb-3">
        <label for="valor" class="form-label">Valor</label>
        <input type="number" step="0.01" min="0" name="Valor" id="valor" class="form-control" required />
      </div>

      <div class="mb-3">
        <label for="dataPedido" class="form-label">Data e Hora do Pedido</label>
        <input type="datetime-local" name="DataPedido" id="dataPedido" class="form-control" required />
      </div>

      <button type="submit" class="btn btn-success">Salvar</button>
      <a href="../index.html" class="btn btn-secondary">Cancelar</a>
    </form>
  </div>
</body>
</html>
