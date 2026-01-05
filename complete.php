<?php
require_once 'config/_db.php';
// Get ID from URL
$id = $_GET['id'] ?? null;
if ($id) {
// Toggle is_completed (0 becomes 1, 1 becomes 0)
$stmt = $pdo->prepare(
"UPDATE todos SET is_completed = NOT is_completed WHERE id = :id"
);
$stmt->execute(['id' => $id]);
}
// Redirect back to home
header('Location: index.php');
exit;