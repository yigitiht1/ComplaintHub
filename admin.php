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
    <h2>Admin Panel</h2>

    <?php foreach ($data as $c): ?>
        <div class="card">
            <strong><?= $c["company"] ?></strong> – <?= $c["subject"] ?>
            <form action="delete.php" method="POST" style="margin-top:10px">
                <input type="hidden" name="id" value="<?= $c["id"] ?>">
                <button class="danger">Sil</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>