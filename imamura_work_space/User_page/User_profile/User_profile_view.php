<?php
 require_once 'User_profile_controller.php';
 ?>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pre_entry</title>
   <link rel="stylesheet" href="User_profile_view.css">
</head>

<body>
    <h1>〇〇ブログ</h1>
    <h2>ユーザープロフィール</h2>
    <div class="main_area"><!--仮登録-->
      <div class="elementArea">
        <div class="message">
          <?php foreach ($userInfo as $key => $value) {?>
            <b><?= htmlspecialchars($key)?></b>:<?= htmlspecialchars($value) ?><br>
            
          <?php } ?>
        </div>
      </div>
      <form method="post" action="User_profile_controller.php">
        <div class="submitArea"> 
          <input type = "submit" id="Logout" name=Logout value = "ログアウト" > 
       </div>
        </form>
    </div>

</body>
</html>
