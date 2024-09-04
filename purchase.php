<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.html');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $machineId = $_POST['machine_id'];
    $price = $_POST['price'];
    $returnAmount = $_POST['return_amount'];

    // Obtém o usuário logado
    $user = json_decode($_SESSION['loggedin'], true);

    // Atualiza o saldo do usuário
    $user['balance'] -= $price;
    // Simula o retorno após um tempo
    // ...

    // Salva as alterações
    $_SESSION['loggedin'] = json_encode($user);
    // Redireciona para a página inicial
    header('Location: index.html');
    exit;
}
?>
