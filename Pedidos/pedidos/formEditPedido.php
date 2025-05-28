<?php
require_once '../init.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$PDO = db_connect();

$sql = "SELECT * FROM Pedidos WHERE idPedido = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$pedido = $stmt->fetch(PDO::FETCH_ASSOC);

$sqlCli = "SELECT idCliente, nomeCliente FROM Cliente";
$stmtCli = $PDO->prepare($sqlCli);
$stmtCli->execute();

if (!is_array($pedido)) {
    echo "Pedido não encontrado";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Pedido</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/estilo.css">

</head>
<body>
  <h2>Editar Pedido</h2>
  <form action="editPedido.php" method="post">
    <input type="hidden" name="id" value="<?= $pedido['idPedido'] ?>">

    <label>Cliente:</label><br>
    <select name="idCliente" required>
      <?php while ($cli = $stmtCli->fetch(PDO::FETCH_ASSOC)): ?>
        <option value="<?= $cli['idCliente'] ?>" <?= ($cli['idCliente'] == $pedido['idCliente']) ? 'selected' : '' ?>>
          <?= $cli['nomeCliente'] ?>
        </option>
      <?php endwhile; ?>
    </select><br><br>

    <div class="mb-3">
        <label for="FormaPagamento" class="form-label">Forma de Pagamento:</label>
        <select name="FormaPagamento" id="FormaPagamento" class="form-select" required>
         <option value="">-- Escolha uma opção --</option>
         <option value="Pix">Pix</option>
         <option value="Dinheiro">Dinheiro</option>
         <option value="Cartao">Cartão</option>
     </select>
    </div>
    
    <label>Valor:</label><br>
    <input type="number" name="Valor" step="0.01" value="<?= $pedido['Valor'] ?>"><br>

    <div class="mb-3">
        <label for="dataPedido" class="form-label">Data e Hora do Pedido</label>
        <input type="datetime-local" name="DataPedido" id="dataPedido" class="form-control" required />
      </div>

    <button type="submit">Atualizar</button>
    <a href="../index.html" class="btn btn-secondary">Voltar</a>
  </form>
</body>
</html>
