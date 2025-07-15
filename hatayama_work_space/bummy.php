<?php
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>home</title>
</head>


<body>
    <header class="site-header">
        <h1>みんなのブログ</h1>
    </header>

    <main class="container">
        <section class="post-list-section">
            <h2>記事一覧</h2>

            <?php
            // ------------------------------------------
            // データベース接続情報 
            // ------------------------------------------

             $host = '133.18.161.106';
             $dbname = 'bbs';
             $username = 'bbs';
             $password = 'bbs!!';
             $charset = 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
    

            $pdo = null; // PDOオブジェクトの初期化

            try {
                $pdo = new PDO($dsn, $username, $password, $options);
            } catch (PDOException $e) {
                error_log("データベース接続エラー: " . $e->getMessage());
                die("現在、サービスに問題が発生しています。しばらくしてから再度お試しください。");
            }

            // ------------------------------------------
            // 記事データの取得
            // ------------------------------------------
            $posts = []; // 記事データを格納する配列

            try {
                // 最新の5件の記事を取得する
                $stmt = $pdo->query("SELECT id, title, excerpt, image_path, posted_at FROM posts ORDER BY posted_at DESC LIMIT 5");
                $posts = $stmt->fetchAll();
            } catch (PDOException $e) {
                error_log("記事取得エラー: " . $e->getMessage());
                echo "<p>記事の読み込みに失敗しました。</p>"; // エラーメッセージ
            }

            ?>


         </section>
    </main>

</body>

