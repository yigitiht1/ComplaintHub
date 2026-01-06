<?php
require "db.php";

$stmt = $pdo->prepare("
    INSERT INTO complaints (company, name, email, subject, message)
    VALUES (?, ?, ?, ?, ?)
");

$stmt->execute([
    $_POST["company"],
    $_POST["name"],
    $_POST["email"],
    $_POST["subject"],
    $_POST["message"]
]);

header("Location: company.php?company=" . urlencode($_POST["company"]));
exit;