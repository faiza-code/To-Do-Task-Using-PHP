<?php
require_once 'config/_db.php';
// Get todo ID from URL ( $_GET )
$id = $_GET['id'] ?? null;
// If no ID, redirect to home
if (!$id) {
    header('Location: index.php');
    exit;
}
// Handle form submission ( UPDATE )
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    if (!empty($title)) {
        $stmt = $pdo->prepare('UPDATE todos SET title = :title WHERE id = :id');
        $stmt->execute(['title' => $title, 'id' => $id]);
    }
    header('Location: index.php');
    exit;
}
// Fetch the todo to edit ( for displaying in form )
$stmt = $pdo->prepare('SELECT * FROM todos WHERE id = :id');
$stmt->execute(['id' => $id]);
$todo = $stmt->fetch(PDO::FETCH_ASSOC);
// If todo not found, redirect
if (!$todo) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <title>Edit Todo</title>
    <link rel='stylesheet' href='./Static/style.css'>
</head>

<body>
    <div class='container'>
        <h1>✏️ Edit Task</h1>
        <form action="edit.php?id=<?= $id ?>" method='POST' class='edit-form'>
            <input type='text'
                name='title'
                value="<?= htmlspecialchars($todo['title']) ?>"
                required>
            <div class='form-buttons'></div>
            <button type='submit'>💾 Save Changes</button>
            <a href='index.php' class='btn-cancel'>Cancel</a>
    </div>
    </form>
    </div>
</body>

</html>