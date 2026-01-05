<?php
require_once 'config/_db.php';
// Get ID from URL
$id = $_GET['id'] ?? null;
if ($id) {
    // Delete the todo
    $stmt = $pdo->prepare('DELETE FROM todos WHERE id = :id');
    $stmt->execute(['id' => $id]);
}
// Redirect back to home
header('Location: index.php');
exit;
