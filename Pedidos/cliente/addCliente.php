<?php
require_once '../init.php';

$nome = $_POST['nomeCliente'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];

$PDO = db_connect();
$sql = "INSERT INTO Cliente (nomeCliente, telefone, endereco) VALUES (:nome, :tel, :end)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':tel', $telefone);
$stmt->bindParam(':end', $endereco);

if ($stmt->execute()) {
    header('Location: exibirClientes.php');
} else {
    echo "Erro ao cadastrar";
    print_r($stmt->errorInfo());
}
?>
