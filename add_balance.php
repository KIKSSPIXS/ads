<?php
$file = 'users.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = trim($_POST['userId']);
    $amount = floatval(trim($_POST['amount']));

    $users = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES) : [];
    $updatedUsers = [];
    $userFound = false;

    foreach ($users as $line) {
        $data = explode(':', $line);
        if (count($data) === 5 && $data[1] === $userId) {
            $data[2] = floatval($data[2]) + $amount;
            $userFound = true;
        }
        $updatedUsers[] = implode(':', $data);
    }

    if ($userFound) {
        file_put_contents($file, implode("\n", $updatedUsers));
        echo 'Saldo adicionado com sucesso.';
    } else {
        echo 'Usuário não encontrado.';
    }
} else {
    echo 'Método inválido.';
}
?>
