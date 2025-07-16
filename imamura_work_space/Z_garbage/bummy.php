
<?php

include 'Server_info.php';//サーバー情報をgitignoreで指定したファイルに隔離



    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
  
    // テーブル作成（testテーブル）
     $sql = "SELECT * FROM LoginTest";
      $stmt = $pdo->query($sql);
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
         foreach ($results as $row) {
        echo "ID: " . htmlspecialchars($row['id']) . "<br>";
        echo "ユーザー名: " . htmlspecialchars($row['user_name']) . "<br>";
        echo "メール: " . htmlspecialchars($row['email_addres']) . "<br>";
        echo "--------------------------------<br>";
    }
} catch (PDOException $e) {
    die("接続エラー: " . $e->getMessage());
}
?>

