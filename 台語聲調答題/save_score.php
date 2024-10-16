<?php
  $scores = json_decode(file_get_contents('php://input'), true);
  if ($scores) {
    file_put_contents('scores.json', json_encode($scores, JSON_PRETTY_PRINT));
  }
?>
