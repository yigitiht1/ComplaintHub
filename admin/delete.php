<?php
require "auth.php";
require "../db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("DELETE FROM complaints WHERE id = ?");
    $stmt->execute([$_POST["id"]]);
}

header("Location: dashboard.php");
exit;