<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>ComplaintHub</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<header class="topbar">
    <div class="topbar-inner">
        <h1>ComplaintHub</h1>

        <form action="company.php" method="GET" class="search-bar">
            <input name="company" placeholder="Firma ara..." required>
            <button>Ara</button>
        </form>

        <a href="admin/login.php" class="admin-link">Admin</a>
    </div>
</header>


<main class="container">
    <div class="card">
        <h2>Şikayet Oluştur</h2>

        <form action="submit.php" method="POST" class="form-grid">
            <input name="company" placeholder="Firma adı" required>
            <input name="name" placeholder="Ad Soyad" required>
            <input name="email" type="email" placeholder="E-posta" required>
            <input name="subject" placeholder="Konu" required>
            <textarea name="message" placeholder="Şikayetiniz" rows="5" required></textarea>

            <button class="primary">Gönder</button>
        </form>
    </div>
</main>

</body>
</html>