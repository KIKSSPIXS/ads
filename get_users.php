<?php
session_start();

// Verifica se o usuário está autenticado e tem permissões administrativas
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || $_SESSION['user_role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['error' => 'Acesso negado.']);
    exit;
}

// Caminho do arquivo
$file = 'users.txt';

$users = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES) : [];
$userList = [];

foreach ($users as $line) {
    $data = explode(':', $line);
    if (count($data) === 5) {
        list($username, $id, $balance, $password, $affiliateCode) = $data;
        $userList[] = [
            'username' => $username,
            'id' => $id,
            'balance' => $balance,
            'password' => $password,
            'affiliateCode' => $affiliateCode
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($userList);
?>
