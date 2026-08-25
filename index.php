<?php
require_once 'includes/task_functions.php';

$filePath = 'data/task.json';
$tasks = getTasks($filePath);

?>

<!DOCTYPE html>
<html>

<head>
  <title>To DO List</title>
</head>

<body>

  <h1>My To Do List</h1>
  <pre> <?php print_r($tasks); ?> </pre>
</body>


</html>
