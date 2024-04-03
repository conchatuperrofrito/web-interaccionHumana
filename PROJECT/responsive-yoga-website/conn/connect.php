<?php
$db_name = 'mysql:host=localhost:666;dbname=web-intereaccion';
// $user_name = 'u712167659_lucho';
$user_name = 'root';
// $user_password = 'unambaA1_';
$user_password = '';
$conn = new PDO($db_name, $user_name, $user_password);
