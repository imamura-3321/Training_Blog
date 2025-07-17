<?php
 require_once 'Sign_up_controller.php';
 ?>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign_up</title>
   <link rel="stylesheet" href="Sign_up_view.css">
</head>

<body>
    <h1>〇〇ブログ</h1>
    <div class="input_form"><!--入力フォームクラス-->
      <form action="Sign_up_controller.php" method="post"> <!-- Sign_up.phpとやり取りする -->
        <div>
          <label for="username">ユーザーネーム<br></label>          <!-- ラベリング -->
          <input type="text" id="username" name="username" required value = "name">  <!-- 入力フォーム　指定する名前　入力を必須化　初期値を追加 -->
        </div>
        <div>
          <label for="emailAddress">メールアドレス<br></label>          <!-- ラベリング -->
          <input type="email" id="emailAddress" name="emailAddress" required >  <!-- 入力フォーム　指定する名前　入力を必須化 -->
        </div>
        <div>
          <label for="pass">パスワード<br></label>          <!-- ラベリング -->
           <input type="password" id="pass" name="pass" required >  <!-- 入力フォーム　指定する名前　入力を必須化 -->
        </div>
        <div>
          <label for="passRe">パスワード確認<br></label>          <!-- ラベリング -->
          <input type="password" id="passRe" name="passRe" required >  <!-- 入力フォーム　指定する名前　入力を必須化 -->
        </div>
        <div class="submitArea"> 
          <input type = "submit" value = "送信" > 
        </div>
      </form>
      <div>
        <label for="error_message">エラーメッセージ<br></label>          <!-- ラベリング -->
        <p><?php echo nl2br(htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8'));  ?></p> <!-- 安全のための変換　エラーメッセージ　クォートで囲む　文字コード -->
      </div>
      
    </div>

</body>
</html>
