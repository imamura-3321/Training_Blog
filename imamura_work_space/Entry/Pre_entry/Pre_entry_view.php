<?php
 require_once 'Pre_entry_controller.php';
 ?>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pre_entry</title>
   <link rel="stylesheet" href="Pre_entry_view.css">
</head>

<body>
    <h1>〇〇ブログ</h1>
    <h2>仮登録</h2>
    <div class="main_area"><!--仮登録-->
      <div class="elementArea">
        <div class="inputRow">
          <label for="username">ユーザーネーム</label><!-- ラベリング -->
          <span><?php echo htmlspecialchars($_SESSION['name'] ,ENT_QUOTES, 'UTF-8');?></span><!-- セッションで渡された値を表示 -->   
        </div>
        <div class="inputRow">
          <label for="email_address">メールアドレス</label>          <!-- ラベリング -->
          <span><?php echo htmlspecialchars($_SESSION['mail'] ,ENT_QUOTES, 'UTF-8');?></span> <!-- セッションで渡された値を表示 -->   
        </div>
        <div class="inputRow">
          <label for="pass">パスワード</label>          <!-- ラベリング -->
          <span><?php echo htmlspecialchars(maskPassword($_SESSION['pass']));;?></span>
        </div>
      </div>
      <form action="Pre_entry_controller.php" method="post"> <!-- Pre_entry_controller.phpとやり取りする -->
        <div class=submitConfirmArea>
           <span>以上の内容で登録しますか？</span>
            <div class="submitArea"> 
              <input type = "submit" name="Yes" value = " はい " > 
              <input type = "submit" name="No" value = "いいえ" > 
            </div>
        </div>
      </form>
    </div>

</body>
</html>
