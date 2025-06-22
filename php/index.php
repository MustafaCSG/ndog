<?php
session_start();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <title>Anasayfa</title>
</head>
<body>
  <nav>
    <a href="index.php">Anasayfa</a>
    <?php if (isset($_SESSION["user"])): ?>
      <span>Hoş geldin, <?php echo htmlspecialchars($_SESSION["user"]["username"]); ?>!</span>
      <a href="php/logout.php">Çıkış Yap</a>
    <?php else: ?>
      <a href="login.html">Giriş Yap</a>
      <a href="register.html">Kayıt Ol</a>
    <?php endif; ?>
  </nav>

  <main>
    <h1>NAUGHTY DOG - Anasayfa</h1>
  </main>
</body>
</html>
