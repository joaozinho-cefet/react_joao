<?php
require_once '../init.php';

$id = $_POST['id'];
$idCliente = $_POST['idCliente'];
$forma = $_POST['FormaPagamento'];
$valor = $_POST['Valor'];
$data = $_POST['DataPedido'];

$PDO = db_connect();
$sql = "UPDATE Pedidos SET idCliente = :cli, FormaPagamento = :forma, Valor = :valor, DataPedido = :data
        WHERE idPedido = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':cli', $idCliente);
$stmt->bindParam(':forma', $forma);
$stmt->bindParam(':valor', $valor);
$stmt->bindParam(':data', $data);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    header('Location: exibirPedidos.php');
} else {
    echo "Erro ao atualizar";
    print_r($stmt->errorInfo());
}
?>
