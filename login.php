<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    $file = 'user.txt';
    
    if (file_exists($file)) {
        $users = file($file, FILE_IGNORE_NEW_LINES);
        foreach ($users as $line) {
            list($user, $userId, $balance, $storedPassword, $affiliateCode) = explode(':', $line);
            if ($user === $username && $storedPassword === $password) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['userId'] = $userId;
                $_SESSION['balance'] = $balance;
                header('Location: profile.php');
                exit;
            }
        }
    }

    echo "Nome de usuário ou senha incorretos!";
}
?>
