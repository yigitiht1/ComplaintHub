<?php
require "auth.php";
require "../db.php";

$page = max(1, (int)($_GET["page"] ?? 1));
$limit = 8;
$offset = ($page - 1) * $limit;

$total = $pdo->query("SELECT COUNT(*) FROM complaints")->fetchColumn();
$pages = ceil($total / $limit);

$stmt = $pdo->prepare("
    SELECT * FROM complaints
    ORDER BY created_at DESC
    LIMIT :limit OFFSET :offset
");
$stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
$stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
$stmt->execute();

$data = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="container">

        <div class="admin-header">
            <h2>Admin Panel</h2>
            <a href="logout.php">Çıkış</a>
        </div>

        <?php foreach ($data as $c): ?>
            <div class="card">
                <strong><?= htmlspecialchars($c["company"]) ?></strong><br>
                <em><?= htmlspecialchars($c["subject"]) ?></em>

                <p><?= nl2br(htmlspecialchars($c["message"])) ?></p>

                <div class="card-footer">
                    <span><?= htmlspecialchars($c["email"]) ?></span>
                    <span><?= date("d.m.Y H:i", strtotime($c["created_at"])) ?></span>
                </div>

                <form action="delete.php" method="POST"
                    onsubmit="return confirm('Bu şikayet silinsin mi?')">
                    <input type="hidden" name="id" value="<?= $c["id"] ?>">
                    <button class="danger">Sil</button>
                </form>
            </div>
        <?php endforeach; ?>

        <div class="pagination">
            <?php for ($i = 1; $i <= $pages; $i++): ?>
                <a href="?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>

    </div>

</body>

</html>