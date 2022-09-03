<?php

$time = time();
$messages = $known_names = [];
[$day, $month] = explode(',', date('j,n', $time));
$unknown_names = FALSE;

for ($delta = 0; $delta < 10; $delta++) {
  $suffix = $delta > 0 ? $delta : '';

  if (
    !empty($_GET['day' . $suffix]) &&
    !empty($_GET['month' . $suffix]) &&
    $_GET['day' . $suffix] == $day &&
    $_GET['month' . $suffix] == $month
  ) {
    if (!empty($_GET['name' . $suffix])) {
      $known_names[] = $_GET['name' . $suffix];
    }
    else {
      $unknown_names = TRUE;
    }
  }
}

if (!empty($known_names) || $unknown_names) {
  if (!empty($known_names)) {
    $messages = $known_names;

    if ($unknown_names) {
      $messages[] = 'and others';
    }
  }

  $messages[] = $_GET['message'] ?: 'Happy birthday!';
}

if (empty($message)) {
  $messages[] = date(strtr($_GET['format'] ?: 'YY/MM/DD', [
    'DD' => 'd',
    'MM' => 'm',
    'YY' => 'y',
    'Day' => 'l',
    'Month' => 'F',
  ]), $time);
}

$response = [
  'frames' => array_map(fn($message) => ['text' => $message], $messages),
];

header('Content-Type: text/json');

print json_encode($response);
