<?php
session_start();
require_once '../includes/db.php';

// Redirect if not logged in
if (!isset($_SESSION['email'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Fetch users
$stmt = $pdo->query("SELECT id, username, email, is_verified, created_at FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include('../includes/header.php'); ?>

<div class="dashboard-container">
    <h2>🧑‍💻 Manage Users</h2>
    <p class="tagline">Here you can view and manage all registered users.</p>

    <div class="table-responsive">
        <table class="user-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Verified</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= $user['is_verified'] ? '✅' : '❌' ?></td>
                    <td><?= date('M j, Y', strtotime($user['created_at'])) ?></td>
                    <td>
                        <form method="post" action="user_actions.php" class="inline-form">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <button name="verify" class="btn small green" <?= $user['is_verified'] ? 'disabled' : '' ?>>✔️ Verify</button>
                            <button name="delete" class="btn small red" onclick="return confirm('Delete this user?')">🗑️ Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
