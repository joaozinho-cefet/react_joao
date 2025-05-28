<?php
require_once '../init.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

if (empty($id)) {
    echo "ID inválido";
    exit;
}

$PDO = db_connect();

// Buscar os dados do produto
$sqlProduto = "SELECT * FROM Produtos WHERE idProduto = :id";
$stmtProduto = $PDO->prepare($sqlProduto);
$stmtProduto->bindParam(':id', $id, PDO::PARAM_INT);
$stmtProduto->execute();
$produto = $stmtProduto->fetch(PDO::FETCH_ASSOC);

if (!is_array($produto)) {
    echo "Produto não encontrado";
    exit;
}

// Buscar as categorias
$sqlCategorias = "SELECT idCategoria, NomeCategoria FROM Categorias ORDER BY NomeCategoria";
$stmtCategoria = $PDO->prepare($sqlCategorias);
$stmtCategoria->execute();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Produto</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/estilo.css">

</head>
<body>
  <div class="container mt-4">
    <h2>Editar Produto</h2>
    <form action="editProduto.php" method="post">
      <input type="hidden" name="id" value="<?= $produto['idProduto'] ?>">

      <div class="mb-3">
        <label for="NomeProduto" class="form-label">Nome:</label>
        <input type="text" name="NomeProduto" id="NomeProduto" class="form-control" value="<?= $produto['NomeProduto'] ?>" required>
      </div>

      <div class="mb-3">
        <label for="QtdProduto" class="form-label">Quantidade:</label>
        <input type="number" name="QtdProduto" id="QtdProduto" class="form-control" value="<?= $produto['QtdProduto'] ?>">
      </div>

      <div class="mb-3">
        <label for="idCategoria" class="form-label">Categoria:</label>
        <select name="idCategoria" id="idCategoria" class="form-select" required>
          <option value="">Selecione a categoria</option>
          <?php while ($cat = $stmtCategoria->fetch(PDO::FETCH_ASSOC)): ?>
            <option value="<?= $cat['idCategoria'] ?>" <?= ($cat['idCategoria'] == $produto['idCategoria']) ? 'selected' : '' ?>>
              <?= $cat['NomeCategoria'] ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Atualizar Produto</button>
      <a href="../index.html" class="btn btn-secondary">Voltar</a>
    </form>
  </div>
</body>
</html>
