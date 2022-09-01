<?php

$time = time();
$fields = ['format', 'message', 'day', 'month'];

if (
  count(array_intersect_key($_GET, array_fill_keys($fields, NULL))) === count($fields) &&
  !empty($_GET['message'])
) {
  [$day, $month] = explode(',', date('j,n', $time));

  if ($_GET['day'] == $day && $_GET['month'] == $month) {
    $message = $_GET['message'];
  }
}

if (empty($message)) {
  $message = date(strtr($_GET['format'], [
    'DD' => 'd',
    'MM' => 'm',
    'YY' => 'y',
    'Day' => 'l',
    'Month' => 'F',
  ]), $time);
}

$response = [
  'frames' => [
    ['text' => $message],
  ],
];

header('Content-Type: text/json');

print json_encode($response);
