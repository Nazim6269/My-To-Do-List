<?php
require_once 'includes/task_functions.php';

$filePath = 'data/task.json';

//=====POST========
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['task'])) {

  $tasks = getTasks($filePath);
  $tasks = addTask($tasks, trim($_POST['task']));

  saveTasks($filePath, $tasks);

  header('Location: index.php');
  exit;
}

//======= GET ========
if (isset($_GET['toggle'])) {
  $task = getTasks($filePath);
  $task = toggleTaskStatus($task, (int) $_GET['toggle']);

  saveTasks($filePath, $task);

  header('Location: index.php');

  exit;
}

//==========Delete =============
if (isset($_DELETE['delete'])) {
  $tasks = getTasks($filePath);
  $tasks = deleteTask($tasks, (int) $_GET['delete']);
  saveTasks($filePath, $tasks);

  header('Location: index.php');
  exit;
}

$tasks = getTasks($filePath);

?>

<!DOCTYPE html>
<html>

<head>
  <title>To DO List</title>
  <style>
    .done {
      text-decoration: line-through;
      color: gray;
    }
  </style>
</head>

<body>

  <h1>My To Do List</h1>


  <form method="POST" action="index.php">

    <input type="text" name="task" placeholder="Enter a new Task" required>
    <button type="submit"> Add Task </button>

  </form>

  <pre> <?php echo renderedTaskList($tasks) ?> </pre>
</body>


</html>
