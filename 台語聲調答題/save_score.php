<?php
  // 取得POST的原始資料
  $data = file_get_contents('php://input');
  
  // 將資料解碼成PHP陣列
  $scores = json_decode($data, true);
  
  // 確認解碼成功
  if ($scores === null) {
    file_put_contents('error_log.txt', 'JSON解碼失敗: ' . json_last_error_msg() . "\n", FILE_APPEND);
    exit;
  }
  
  // 將新的分數加入到現有分數中
  $existingScores = [];
  if (file_exists('scores.json')) {
    $existingScores = json_decode(file_get_contents('scores.json'), true);
    if ($existingScores === null) {
      file_put_contents('error_log.txt', '無法讀取scores.json: ' . json_last_error_msg() . "\n", FILE_APPEND);
      $existingScores = [];
    }
  }

  $existingScores = array_merge($existingScores, $scores);
  
  // 將更新後的分數資料儲存回scores.json
  $result = file_put_contents('scores.json', json_encode($existingScores, JSON_PRETTY_PRINT));
  
  if ($result === false) {
    file_put_contents('error_log.txt', '無法寫入scores.json' . "\n", FILE_APPEND);
  } else {
    file_put_contents('error_log.txt', '成功寫入scores.json' . "\n", FILE_APPEND);
  }
?>
