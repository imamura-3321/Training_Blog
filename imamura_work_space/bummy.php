<?php

include 'Server_info.php';//サーバー情報をgitignoreで指定したファイルに隔離


try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
  
    // テーブル作成（testテーブル）
    $sqlCreate = "
    CREATE TABLE IF NOT EXISTS test (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    $pdo->exec($sqlCreate);
    
    // データ挿入（例として2件）
    $pdo->exec("INSERT INTO test (username, email) VALUES ('tanaka', 'tanaka@example.com')");
    $pdo->exec("INSERT INTO test (username, email) VALUES ('suzuki', 'suzuki@example.com')");

    // データ取得
    $stmt = $pdo->query("SELECT * FROM test");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("接続エラー: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8" />
    <title>testテーブルの内容表示</title>
</head>
<body>
    <h1>testテーブルの内容</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>id</th><th>username</th><th>email</th><th>created_at</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
            <tr>
                <td><?=htmlspecialchars($row['id'])?></td>
                <td><?=htmlspecialchars($row['username'])?></td>
                <td><?=htmlspecialchars($row['email'])?></td>
                <td><?=htmlspecialchars($row['created_at'])?></td>
            </tr>
            <?php endforeach; ?>