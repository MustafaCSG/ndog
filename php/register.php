<?php
// register.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $surname = isset($_POST['surname']) ? trim($_POST['surname']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $passwordVerif = isset($_POST['password-verification']) ? $_POST['password-verification'] : '';

    if ($username === '') {
        echo "<script>alert('Kullanıcı adı boş olamaz.'); window.history.back();</script>";
        exit;
    }

    if ($password !== $passwordVerif) {
        echo "<script>alert('Şifreler eşleşmiyor.'); window.history.back();</script>";
        exit;
    }

    // Dosya varsa oku
    $data_file = '../users.json';
    $users = file_exists($data_file) ? json_decode(file_get_contents($data_file), true) : [];

    // Aynı kullanıcı adı var mı kontrol et
    foreach ($users as $user) {
        if (isset($user['username']) && $user['username'] === $username) {
            echo "<script>alert('Bu kullanıcı adı zaten alınmış.'); window.history.back();</script>";
            exit;
        }
    }

    // Kullanıcıyı kaydet
    $users[] = [
        'username' => $username,
        'name' => $name,
        'surname' => $surname,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT)
    ];

    file_put_contents($data_file, json_encode($users, JSON_PRETTY_PRINT));
    echo "<script>alert('Kayıt başarılı!'); window.location.href = '../login.html';</script>";
    exit;
}
?>
