<?php
session_start();

// Verifica se o usuário está autenticado e tem permissões administrativas
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || $_SESSION['user_role'] !== 'admin') {
    http_response_code(403);
    echo 'Acesso negado.';
    exit;
}

// Caminho do arquivo
$file = 'users.txt';

// Verifica se o ID do usuário foi enviado via GET
if (isset($_GET['searchId'])) {
    $searchId = trim($_GET['searchId']);
    
    $users = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES) : [];
    $userData = [];

    foreach ($users as $line) {
        $data = explode(':', $line);
        if (count($data) === 5) {
            list($user, $userIdFromFile, $balance, $password, $affiliateCode) = $data;
            
            if ($userIdFromFile === $searchId) {
                $userData = [
                    'user' => $user,
                    'id' => $userIdFromFile,
                    'balance' => $balance,
                    'password' => $password,
                    'affiliate' => $affiliateCode
                ];
                break;
            }
        }
    }

    if (!empty($userData)) {
        echo '<h3>Dados do Usuário</h3>';
        echo 'Usuário: ' . htmlspecialchars($userData['user']) . '<br>';
        echo 'ID: ' . htmlspecialchars($userData['id']) . '<br>';
        echo 'Saldo: R$ ' . htmlspecialchars($userData['balance']) . '<br>';
        echo 'Senha: ' . htmlspecialchars($userData['password']) . '<br>';
        echo 'Código de Afiliado: ' . htmlspecialchars($userData['affiliate']) . '<br>';
    } else {
        echo 'Usuário não encontrado.';
    }
} else {
    echo 'ID do usuário ausente.';
}
?>
