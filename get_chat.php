<?php
// get_chat.php
$chat_file = 'chat.txt';
$chat_data = file_get_contents($chat_file);
echo $chat_data;

