<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['email'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Fetch all items
$stmt = $pdo->query("SELECT id, title, price, created_at, user_email FROM items ORDER BY created_at DESC");
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include('../includes/header.php'); ?>

<div class="dashboard-container">
    <h2>📦 Manage Items</h2>
    <p class="tagline">View and moderate all marketplace items posted by users.</p>

    <div class="table-responsive">
        <table class="user-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Posted By (Email)</th>
                    <th>Price</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['title']) ?></td>
                    <td><?= htmlspecialchars($item['user_email']) ?></td>
                    <td>₦<?= number_format($item['price'], 2) ?></td>
                    <td><?= date('M j, Y', strtotime($item['created_at'])) ?></td>
                    <td>
                        <form method="post" action="item_actions.php" class="inline-form">
                            <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                            <a href="../listings/single_item.php?id=<?= $item['id'] ?>" target="_blank" class="btn-view">👁 View</a>
                            <button name="delete" class="btn small red" onclick="return confirm('Delete this item?')">🗑️ Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
