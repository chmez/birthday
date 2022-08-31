<?php

$frames = [];

$fields = ['message', 'day', 'month'];

if (
  count(array_intersect_key($_GET, array_fill_keys($fields, NULL))) === count($fields) &&
  !empty($_GET['message'])
) {
  [$day, $month] = explode(',', date('j,n'));

  if ($_GET['day'] == $day && $_GET['month'] == $month) {
    $frames[] = ['text' => $_GET['message']];
  }
}

$response = ['frames' => [$frames]];

header('Content-Type: text/json');

print json_encode($response);
