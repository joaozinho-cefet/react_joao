<?php
require_once '../init.php';

$id = $_POST['id'];
$nome = $_POST['NomeCategoria'];

$PDO = db_connect();
$sql = "UPDATE Categorias SET NomeCategoria = :nome WHERE idCategoria = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    header('Location: exibirCategorias.php');
} else {
    echo "Erro ao atualizar";
    print_r($stmt->errorInfo());
}
?>
