<?php

//============== Task List ==========
function getTasks(string $filePath): array
{

  if (!file_exists($filePath)) {

    return [];
  }

  $jsonContent = file_get_contents($filePath);

  if ($jsonContent == false || $jsonContent == '') {
    return [];
  }

  $tasks = json_decode($jsonContent, true);

  if (!is_array($tasks)) {
    return [];
  }

  return $tasks;
}

//========= render list =============
function renderedTaskList(array $tasks): string
{

  if (empty($tasks)) {
    return '<p> Not Task Yet. Add one above';
  }

  $html = '<ul>';

  foreach ($tasks as $task) {
    $status = $task['done'] ? 'done' : 'pending';
    $label  = $task['done'] ? '☑' : '☐';

    $html .= '<li class="' . $status . '">';

    $html .= '<a href="index.php?toggle= ' . $task['id'] . '">' . $label . '</a>';

    $html .= htmlspecialchars($task['task']);
    $html .= '</li>';
  }

  $html .= '</ul>';
  return $html;
}


//============== Save Task==============
function saveTasks(string $filePath, array $tasks): bool
{
  $jsonContent = json_encode($tasks, JSON_PRETTY_PRINT);


  if ($jsonContent == false) {
    return false;
  }

  return file_put_contents($filePath, $jsonContent) !== false;
}


//============= add Task =================
function addTask(array $tasks, string $taskText): array
{

  $newId = empty($tasks) ? 1 : max(array_column($tasks, 'id')) + 1;

  $tasks[] = [
    'id' => $newId,
    'task' => $taskText,
    'done' => false,
  ];

  return $tasks;
}

//============= Toggle Task Status ===========

function toggleTaskStatus(array $tasks, int $taskId): array
{

  foreach ($tasks as &$task) {
    if ($task['id'] == $taskId) {
      $task['done'] = !$task['done'];

      break;
    }
  }

  unset($task);

  return $tasks;
}
