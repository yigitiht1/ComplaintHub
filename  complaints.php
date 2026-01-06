<?php
require "db.php";

$data = $pdo->query("
    SELECT * FROM complaints ORDER BY created_at DESC
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Tüm Şikayetler</h2>

    <?php foreach ($data as $c): ?>
        <div class="card">
            <strong><?= htmlspecialchars($c["company"]) ?></strong><br>
            <?= htmlspecialchars($c["subject"]) ?>
            <p><?= nl2br(htmlspecialchars($c["message"])) ?></p>
            <a href="company.php?company=<?= urlencode($c["company"]) ?>">
                Bu firma için tüm şikayetler
            </a>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>