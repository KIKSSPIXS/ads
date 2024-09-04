<?php
session_start();

// Função para gerar um ID único
function generateUniqueId() {
    return mt_rand(1000, 9999);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $affiliateCode = trim($_POST['affiliateCode']);
    
    $file = 'user.txt';
    
    // Verifica se o usuário já existe
    if (file_exists($file)) {
        $users = file($file, FILE_IGNORE_NEW_LINES);
        foreach ($users as $line) {
            list($user, , , ,) = explode(':', $line);
            if ($user === $username) {
                echo "Usuário já existe!";
                exit;
            }
        }
    }

    // Gera um ID único e define saldo inicial
    $userId = generateUniqueId();
    $balance = 0.00;

    // Adiciona o novo usuário ao arquivo
    $newUser = "$username:$userId:$balance:$password:$affiliateCode\n";
    file_put_contents($file, $newUser, FILE_APPEND);

    // Redireciona para a página de login
    header('Location: login.html');
    exit;
}
?>
