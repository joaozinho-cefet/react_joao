<?php
require_once '../init.php';

$PDO = db_connect();

// Verifica se os dados foram enviados
if (
    isset($_POST['idCliente'], $_POST['produtos'], $_POST['FormaPagamento'], $_POST['Valor'], $_POST['DataPedido'])
    && !empty($_POST['produtos'])
) {
    $idCliente = $_POST['idCliente'];
    $produtos = $_POST['produtos']; // array de ids de produtos
    $formaPagamento = $_POST['FormaPagamento'];
    $valor = $_POST['Valor'];
    $dataPedido = $_POST['DataPedido'];

    try {
        // Começa transação
        $PDO->beginTransaction();

        // Insere pedido
        $sqlPedido = "INSERT INTO Pedidos (idCliente, FormaPagamento, Valor, DataPedido) VALUES (:idCliente, :formaPagamento, :valor, :dataPedido)";
        $stmtPedido = $PDO->prepare($sqlPedido);
        $stmtPedido->execute([
            ':idCliente' => $idCliente,
            ':formaPagamento' => $formaPagamento,
            ':valor' => $valor,
            ':dataPedido' => $dataPedido
        ]);

        // Pega o ID do pedido inserido
        $idPedido = $PDO->lastInsertId();

        // Insere na tabela de relacionamento PedidosProdutos
        $sqlPedProd = "INSERT INTO PedidosProdutos (idPedido, idProduto) VALUES (:idPedido, :idProduto)";
        $stmtPedProd = $PDO->prepare($sqlPedProd);

        foreach ($produtos as $idProduto) {
            $stmtPedProd->execute([
                ':idPedido' => $idPedido,
                ':idProduto' => $idProduto
            ]);
        }

        // Confirma transação
        $PDO->commit();

        header('Location: exibirPedidos.php');
        exit;

    } catch (Exception $e) {
        $PDO->rollBack();
        echo "Erro ao salvar pedido: " . $e->getMessage();
    }

} else {
    echo "Dados incompletos!";
}
