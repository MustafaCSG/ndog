<?php
$data_file = 'users.json';
$username = $_POST['username'];
$password = $_POST['password'];

if (!file_exists($data_file)) {
    die('Kayıtlı kullanıcı bulunamadı.');
}

$users = json_decode(file_get_contents($data_file), true);

foreach ($users as $user) {
    if ($user['username'] === $username && password_verify($password, $user['password'])) {
        echo 'Giriş başarılı. <script>localStorage.setItem("user", "' . $username . '"); window.location.href = "../index.html";</script>';
        exit;
    }
}

echo '<script>alert("Kullanıcı adı veya şifre hatalı."); window.history.back();</script>';
?>
