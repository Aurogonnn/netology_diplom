<?php
// /ajax/test_simple.php
header('Content-Type: application/json');

// Просто возвращаем JSON без Битрикса
echo json_encode([
    'test' => 'OK',
    'time' => date('Y-m-d H:i:s')
]);
exit;
?>