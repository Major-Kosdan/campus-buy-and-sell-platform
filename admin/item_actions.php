<?php
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'])) {
    $itemId = $_POST['item_id'];

    if (isset($_POST['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM items WHERE id = ?");
        $stmt->execute([$itemId]);
    }
}

header("Location: manage_items.php");
exit();
