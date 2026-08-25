<?php


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
