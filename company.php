<?php
require "db.php";


$company = $_GET["company"] ?? "";
$page = max(1, (int)($_GET["page"] ?? 1));

$limit = 5;
$offset = ($page - 1) * $limit;


function maskEmail($email) {
    if (!str_contains($email, "@")) return "***";
    [$user, $domain] = explode("@", $email);
    return substr($user, 0, 1) . "***@" . $domain;
}


$countStmt = $pdo->prepare("
    SELECT COUNT(*) 
    FROM complaints 
    WHERE company LIKE ?
");
$countStmt->execute(["%$company%"]);
$total = (int)$countStmt->fetchColumn();


$stmt = $pdo->prepare("
    SELECT subject, message, email, created_at
    FROM complaints
    WHERE company LIKE ?
    ORDER BY created_at DESC
    LIMIT $limit OFFSET $offset
");
$stmt->execute(["%$company%"]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pages = max(1, ceil($total / $limit));
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($company) ?> Şikayetleri</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="topbar">
    <div class="topbar-inner">
        <h1><?= htmlspecialchars($company) ?></h1>
        <a href="index.php" class="admin-link">← Ana Sayfa</a>
    </div>
</header>

<main class="container">

<?php if (!$data): ?>
    <div class="card">
        <p>Bu firma için henüz şikayet bulunmuyor.</p>
    </div>
<?php endif; ?>

<?php foreach ($data as $c): ?>
    <div class="card">
        <strong><?= htmlspecialchars($c["subject"]) ?></strong>

        <p><?= nl2br(htmlspecialchars($c["message"])) ?></p>

        <div class="card-footer">
            <span><?= htmlspecialchars(maskEmail($c["email"])) ?></span>
            <span><?= date("d.m.Y H:i", strtotime($c["created_at"])) ?></span>
        </div>
    </div>
<?php endforeach; ?>

<?php if ($pages > 1): ?>
    <div class="pagination">
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <a href="?company=<?= urlencode($company) ?>&page=<?= $i ?>"
               class="<?= $i == $page ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
<?php endif; ?>

</main>

</body>
</html>