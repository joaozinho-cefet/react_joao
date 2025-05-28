<?php
require_once '../init.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

if (empty($id)) {
    echo "ID não informado";
    exit;
}

$PDO = db_connect();
$sql = "DELETE FROM Cliente WHERE idCliente = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    header('Location: exibirClientes.php');
} else {
    echo "Erro ao remover";
    print_r($stmt->errorInfo());
}
?>
