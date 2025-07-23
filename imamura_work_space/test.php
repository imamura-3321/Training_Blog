<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            color: #333;
        }

        header {
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        header h1 {
            margin: 0;
            font-size: 2.5rem;
        }

        nav {
            margin-top: 10px;
        }

        nav a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .post {
            background: white;
            margin-bottom: 30px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: transform 0.2s ease-in-out;
        }

        .post:hover {
            transform: translateY(-5px);
        }

        .post img {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .post h2 {
            margin-top: 0;
            font-size: 1.8rem;
            color: #3b82f6;
        }

        .post .meta {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #3b82f6;
            color: white;
            margin-top: 50px;
        }

        footer a {
            color: #e0e0e0;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header>
        <h1>My Awesome Blog</h1>
        <nav>
            <a href="#">ホーム</a>
            <a href="#">記事一覧</a>
            <a href="#">プロフィール</a>
            <a href="#">お問い合わせ</a>
        </nav>
    </header>

    <div class="container">
        <article class="post">
            <img src="https://source.unsplash.com/random/800x400?technology" alt="サンプル画像">
            <h2>初めてのブログ記事</h2>
            <p class="meta">2025年7月23日 | カテゴリ: 日記</p>
            <p>これはサンプルの記事です。ここにブログの本文が入ります。テキスト、画像、リンクなどを使って自由にコンテンツを作成できます。Webデザインの勉強やポートフォリオにも使えるデザインです。</p>
        </article>

        <article class="post">
            <img src="https://source.unsplash.com/random/800x400?coding" alt="サンプル画像">
            <h2>プログラミングを始める理由</h2>
            <p class="meta">2025年7月20日 | カテゴリ: プログラミング</p>
            <p>プログラミングは現代社会で欠かせないスキルの1つです。この記事では、初心者が学び始める際のポイントをまとめています。</p>
        </article>
    </div>

    <footer>
        <p>&copy; 2025 My Blog | <a href="#">プライバシーポリシー</a></p>
    </footer>
</body>
</html>