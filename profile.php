<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.html');
    exit;
}

// Caminho do arquivo de usuários
$file = 'user.txt';
$username = $_SESSION['username'];
$userData = [
    'id' => 'Não disponível',
    'username' => 'Não disponível',
    'balance' => 'R$ 0.00'
];

// Lê os dados do arquivo de usuários
if (file_exists($file)) {
    $users = file($file, FILE_IGNORE_NEW_LINES);
    foreach ($users as $line) {
        list($user, $userId, $balance, $password, $affiliateCode) = explode(':', $line);
        if ($user === $username) {
            $userData['id'] = $userId;
            $userData['username'] = $user;
            $userData['balance'] = 'R$ ' . number_format($balance, 2, ',', '.');
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <h1>Meu Perfil</h1>
    </header>

    <div class="profile-content">
        <h2>Informações do Perfil</h2>
        <p>ID: <?php echo htmlspecialchars($userData['id']); ?></p>
        <p>Nome de Usuário: <?php echo htmlspecialchars($userData['username']); ?></p>
        <p>Saldo: <?php echo htmlspecialchars($userData['balance']); ?></p>
        <a href="logout.php">Sair</a>
    </div>
</body>
</html>
