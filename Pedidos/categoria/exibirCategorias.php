<?php
require_once '../init.php';

$PDO = db_connect();
$sql = "SELECT * FROM Categorias ORDER BY NomeCategoria ASC";
$stmt = $PDO->prepare($sql);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Categorias</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/estilo.css">

</head>
<body>
  <div class="container">
    <h2>Categorias Cadastradas</h2>
    <a href="formAddCategoria.html" class="btn btn-success mb-3">Nova Categoria</a>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th colspan="2">Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($cat = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
          <td><?= $cat['idCategoria'] ?></td>
          <td><?= $cat['NomeCategoria'] ?></td>
          <td><a href="formEditCategoria.php?id=<?= $cat['idCategoria'] ?>" class="btn btn-primary">Editar</a></td>
          <td><a href="deleteCategoria.php?id=<?= $cat['idCategoria'] ?>" class="btn btn-danger" onclick="return confirm('Deseja realmente remover?');">Remover</a></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <a href="../index.html" class="btn btn-secondary">Voltar</a>
  </div>
</body>
</html>
