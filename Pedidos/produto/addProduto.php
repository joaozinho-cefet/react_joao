<?php
require_once '../init.php';

$nome = $_POST['NomeProduto'];
$qtd = $_POST['QtdProduto'];
$idCategoria = $_POST['idCategoria'];

$PDO = db_connect();
$sql = "INSERT INTO Produtos (NomeProduto, QtdProduto, idCategoria)
        VALUES (:nome, :qtd, :cat)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':qtd', $qtd);
$stmt->bindParam(':cat', $idCategoria);

if ($stmt->execute()) {
    header('Location: exibirProdutos.php');
} else {
    echo "Erro ao cadastrar";
    print_r($stmt->errorInfo());
}
?>
