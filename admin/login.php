<?php
session_start();
require "../db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$_POST["username"]]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($_POST["password"], $admin["password"])) {
        $_SESSION["admin"] = true;
        header("Location: dashboard.php");
        exit;
    }

    $error = "Kullanıcı adı veya şifre hatalı";
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin Giriş</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="container" style="max-width:420px">
    <div class="card">
        <h2 style="text-align:center">Admin Girişi</h2>

        <?php if ($error): ?>
            <p style="color:#dc2626; text-align:center"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST" class="form-grid">
            <input name="username" placeholder="Kullanıcı adı" required>
            <input name="password" type="password" placeholder="Şifre" required>
            <button class="primary">Giriş Yap</button>
        </form>

        <p style="text-align:center; margin-top:15px">
            <a href="../index.php">← Ana Sayfa</a>
        </p>
    </div>
</div>

</body>
</html>