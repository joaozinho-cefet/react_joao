<?php
require_once '../init.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

if (empty($id)) {
    echo "ID inválido";
    exit;
}

$PDO = db_connect();
$sql = "SELECT * FROM Categorias WHERE idCategoria = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$cat = $stmt->fetch(PDO::FETCH_ASSOC);

if (!is_array($cat)) {
    echo "Categoria não encontrada";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Categoria</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/estilo.css">

</head>
<body>
  <h2>Editar Categoria</h2>
  <form action="editCategoria.php" method="post">
    <input type="hidden" name="id" value="<?= $id ?>">
    <label>Nome:</label><br>
    <input type="text" name="NomeCategoria" value="<?= $cat['NomeCategoria'] ?>"><br><br>
    <button type="submit">Atualizar</button>
    <a href="../index.html" class="btn btn-secondary">Voltar</a>
  </form>
</body>
</html>
