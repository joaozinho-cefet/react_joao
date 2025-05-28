<?php
require_once '../init.php';

$nome = $_POST['NomeCategoria'];

$PDO = db_connect();
$sql = "INSERT INTO Categorias (NomeCategoria) VALUES (:nome)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $nome);

if ($stmt->execute()) {
    header('Location: exibirCategorias.php');
} else {
    echo "Erro ao cadastrar";
    print_r($stmt->errorInfo());
}
?>
