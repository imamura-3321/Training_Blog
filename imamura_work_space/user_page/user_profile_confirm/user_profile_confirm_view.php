<?php
 require_once 'user_profile_confirm_controller.php';
 ?>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pre_entry</title>
   <link rel="stylesheet" href="user_profile_confirm_view.css">
</head>

<body>
    <h1>〇〇ブログ</h1>
    <h2>ユーザープロフィール</h2>
     <div class="main_area"><!--仮登録-->
      <div class="elementArea">
        <div class="inputRow">
          <label for="username">ユーザーネーム</label><!-- ラベリング -->
          <span><?php echo htmlspecialchars( $userName ,ENT_QUOTES, 'UTF-8');?></span><!-- セッションで渡された値を表示 -->   
        </div>
        <div class="inputRow">
          <label for="email_address">ユーザーアイコン</label>          <!-- ラベリング -->
          <span><?php echo htmlspecialchars( $faileName ,ENT_QUOTES, 'UTF-8');?></span> <!-- セッションで渡された値を表示 -->   
        </div>
        <div class="inputRow">
          <label for="pass">ユーザー自己紹介</label>          <!-- ラベリング -->
          <span><?php echo htmlspecialchars($userBio ,ENT_QUOTES, 'UTF-8');?></span>
        </div>
      </div>
      <form action="user_profile_confirm_controller.php"   method="post"> <!-- Pre_entry_controller.phpとやり取りする -->
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
