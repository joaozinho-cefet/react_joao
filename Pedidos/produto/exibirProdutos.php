<?php
require_once '../init.php';

$PDO = db_connect();
$sql = "SELECT P.idProduto, P.NomeProduto, P.QtdProduto, C.NomeCategoria 
        FROM Produtos P
        JOIN Categorias C ON P.idCategoria = C.idCategoria
        ORDER BY P.NomeProduto ASC";
$stmt = $PDO->prepare($sql);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Lista de Produtos</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/estilo.css">

</head>
<body>
  <div class="container">
    <h2>Produtos Cadastrados</h2>
    <a href="formAddProduto.php" class="btn btn-success mb-3">Novo Produto</a>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Quantidade</th>
          <th>Categoria</th>
          <th colspan="2">Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($produto = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
          <td><?= $produto['idProduto'] ?></td>
          <td><?= $produto['NomeProduto'] ?></td>
          <td><?= $produto['QtdProduto'] ?></td>
          <td><?= $produto['NomeCategoria'] ?></td>
          <td><a href="formEditProduto.php?id=<?= $produto['idProduto'] ?>" class="btn btn-primary">Editar</a></td>
          <td><a href="deleteProduto.php?id=<?= $produto['idProduto'] ?>" class="btn btn-danger" onclick="return confirm('Deseja realmente remover?');">Remover</a></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <a href="../index.html" class="btn btn-secondary">Voltar</a>
  </div>
</body>
</html>
