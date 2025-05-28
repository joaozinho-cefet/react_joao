<?php
require_once '../init.php';

$id = $_POST['id'];
$nome = $_POST['NomeProduto'];
$qtd = $_POST['QtdProduto'];
$cat = $_POST['idCategoria'];

$PDO = db_connect();
$sql = "UPDATE Produtos SET NomeProduto = :nome, QtdProduto = :qtd, idCategoria = :cat WHERE idProduto = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':qtd', $qtd);
$stmt->bindParam(':cat', $cat);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    header('Location: exibirProdutos.php');
} else {
    echo "Erro ao atualizar";
    print_r($stmt->errorInfo());
}
?>
