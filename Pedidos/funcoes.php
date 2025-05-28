<?php

function db_connect() {
    try {
        $PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $PDO;
    } catch (PDOException $e) {
        echo 'Erro na conexão: ' . $e->getMessage();
        exit;
    }
}

function converteData($dataStr) {
    $data = new DateTime($dataStr);
    return $data->format('d/m/Y');
}

function converteHora($dataStr) {
    $data = new DateTime($dataStr);
    return $data->format('H:i');
}



?>


