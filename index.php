<?php
require_once 'config/_db.php';
// Fetch all todos from database
$stmt = $pdo->query('SELECT * FROM todos ORDER BY created_at DESC');
$todos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Todo App</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' href='Static/style.css'>
</head>

<body>
    <div class='container'>
        <h1>📝 My Todo List</h1>
        <!-- Add Todo Form -->
        <form action='create.php' method='POST' class='add-form'>
            <input type='text' name='title' placeholder='Enter a new task...' required>
            <button type='submit'>Add Task</button>
        </form>
        <!-- Todo List -->
        <ul class='todo-list'>
            <?php if (empty($todos)): ?>
                <li class='empty'>No tasks yet. Add one above!</li>
            <?php else: ?>
                <?php foreach ($todos as $todo): ?>
                    <li class="<?= $todo['is_completed'] ? 'completed' : '' ?>">
                        <span class='title'>
                            <?=htmlspecialchars( $todo[ 'title' ] ) ?>
                        </span>
                        <div class='actions'>

                            <a href="complete.php?id=<?= $todo['id'] ?>" class="btn-complete">
                            <?= $todo['is_completed'] ? '↩️ Undo' : '✅ Done' ?>
                            </a>
                            <a href="edit.php?id=<?= $todo['id'] ?>" class="btn-edit">
                            ✏️ Edit
                            </a>
                            <a href="delete.php?id=<?= $todo['id'] ?>"
                            class="btn-delete"
                            onclick="return confirm('Delete this task?')">
                            🗑️ Delete
                            </a>
                        </div>
                    </li>
                <?php endforeach;
                ?>
            <?php endif;
            ?>
        </ul>
    </div>
</body>

</html>