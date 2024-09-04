<?php
session_start();

// Verifica se o usuário está autenticado e tem permissões administrativas
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || $_SESSION['user_role'] !== 'admin') {
    http_response_code(403);
    echo 'Acesso negado.';
    exit;
}

// Recebe dados do formulário
$machineName = $_POST['machineName'];
$price = $_POST['price'];
$returnAmount = $_POST['returnAmount'];
$time = $_POST['time'];
$quantity = $_POST['quantity'];

// Caminho do arquivo onde as máquinas serão armazenadas
$file = 'machines.txt';

// Verifica se o arquivo existe
if (!file_exists($file)) {
    $fileHandle = fopen($file, 'w');
    fclose($fileHandle);
}

// Adiciona a nova máquina ao arquivo
$machineData = implode(':', [$machineName, $price, $returnAmount, $time, $quantity]) . PHP_EOL;
file_put_contents($file, $machineData, FILE_APPEND);

// Redireciona de volta para o painel de administração
header('Location: admin.html');
exit;
?>
