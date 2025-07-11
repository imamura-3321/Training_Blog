<?php
$host = 'training_db';
$port = 3306;
$dbname = 'school';
$user = 'root';
$pass = 'root';

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
    ]);
    echo "接続成功";
} catch (PDOException $e) {
    echo "接続エラー: " . $e->getMessage();
}