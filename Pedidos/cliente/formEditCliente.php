<?php
require_once '../init.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

if (empty($id)) {
    echo "ID inválido";
    exit;
}

$PDO = db_connect();
$sql = "SELECT nomeCliente, telefone, endereco FROM Cliente WHERE idCliente = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!is_array($cliente)) {
    echo "Cliente não encontrado";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Cliente</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/estilo.css">

</head>
<body>
  <h2>Editar Cliente</h2>
  <form action="editCliente.php" method="post">
    <input type="hidden" name="id" value="<?= $id ?>">
    <label>Nome:</label><br>
    <input type="text" name="nomeCliente" value="<?= $cliente['nomeCliente'] ?>"><br>
    <label>Telefone:</label><br>
    <input type="text" name="telefone" value="<?= $cliente['telefone'] ?>"><br>
    <label>Endereço:</label><br>
    <input type="text" name="endereco" value="<?= $cliente['endereco'] ?>"><br><br>
    <button type="submit">Atualizar</button>
    <a href="../index.html" class="btn btn-secondary">Voltar</a>
  </form>
</body>
</html>
