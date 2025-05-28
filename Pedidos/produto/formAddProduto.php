<?php
require_once '../init.php';

$PDO = db_connect();
$sql = "SELECT idCategoria, NomeCategoria FROM Categorias ORDER BY NomeCategoria";
$stmt = $PDO->prepare($sql);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Produto</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/estilo.css">

</head>
<body>
  <div class="container mt-4">
    <h2>Cadastrar Produto</h2>
    <form action="addProduto.php" method="post">
      <div class="mb-3">
        <label for="NomeProduto" class="form-label">Nome do Produto:</label>
        <input type="text" name="NomeProduto" id="NomeProduto" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="QtdProduto" class="form-label">Quantidade:</label>
        <input type="number" name="QtdProduto" id="QtdProduto" class="form-control">
      </div>

      <div class="mb-3">
        <label for="idCategoria" class="form-label">Categoria:</label>
        <select name="idCategoria" id="idCategoria" class="form-select" required>
          <option value="">Selecione a categoria</option>
          <?php while ($cat = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <option value="<?= $cat['idCategoria'] ?>"><?= $cat['NomeCategoria'] ?></option>
          <?php endwhile; ?>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
      <a href="../index.html" class="btn btn-secondary">Voltar</a>
    </form>
  </div>
</body>
</html>
