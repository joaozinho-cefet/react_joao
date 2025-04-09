<?php
include 'dados.php';
?>

!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Site Muito Foda</title>
</head>
<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Idade</th>
                <th scope="col">Estilo preferido</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($dados as $linha => $item):?>
                <tr>
                    <th scope="row"><?php echo $item['nome']?></th>
                    <td></td>
                </tr>
        </tbody>
    </table>
</body>