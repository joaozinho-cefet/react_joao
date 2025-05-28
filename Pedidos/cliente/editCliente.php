<?php
require_once '../init.php';

$id = $_POST['id'];
$nome = $_POST['nomeCliente'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];

$PDO = db_connect();
$sql = "UPDATE Cliente SET nomeCliente = :nome, telefone = :tel, endereco = :end WHERE idCliente = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':tel', $telefone);
$stmt->bindParam(':end', $endereco);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    header('Location: exibirClientes.php');
} else {
    echo "Erro ao atualizar";
    print_r($stmt->errorInfo());
}
?>
