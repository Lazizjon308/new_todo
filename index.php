<?php
require_once 'DB.php';

$db = new DB();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task'])) {
    $db->addTask($_POST['task']);
    header("Location: index.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $db->deleteTask($_POST['delete']);
    header("Location: index.php");
    exit();
}

$tasks = $db->getTasks();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 300px; margin: auto; text-align: center; }
        .task-list { list-style-type: none; padding: 0; }
        .task-item {
            background: #f4f4f4; padding: 8px; margin: 5px 0;
            border-radius: 5px; display: flex; justify-content: space-between;
        }
        .delete-btn { background: red; color: white; border: none; padding: 5px; cursor: pointer; border-radius: 3px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Todo List</h1>

        
        <form method="POST">
            <input type="text" name="task" placeholder="Enter a task..." required>
            <button type="submit">Add Task</button>
        </form>

        
        <ul class="task-list">
            <?php foreach ($tasks as $task): ?>
                <li class="task-item">
                    <?php echo htmlspecialchars($task['tasks']); ?>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="delete" value="<?php echo $task['id']; ?>">
                        <button type="submit" class="delete-btn">X</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
