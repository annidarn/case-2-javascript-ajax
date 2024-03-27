<?php

date_default_timezone_set('Asia/Jakarta');
$chat_file = 'chat.txt';
$username = $_POST['username'];
$message = $_POST['message'];
$chat_entry = date('Y-m-d H:i:s') . ' - ' . $username . ': ' . $message . "\n";
file_put_contents($chat_file, $chat_entry, FILE_APPEND);