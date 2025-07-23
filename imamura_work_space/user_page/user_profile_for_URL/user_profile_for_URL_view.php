<?php
 require_once 'user_profile_for_URL_controller.php';
 ?>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pre_entry</title>
   <link rel="stylesheet" href="user_profile_for_URL_view.css">
</head>

<body>
    <h1>〇〇ブログ</h1>
    <h2>ユーザープロフィール</h2>
    <div class="main_area"><!--仮登録-->
      <div class="elementArea">
        <div class="bigText">
          <label for="username">本登録が完了しました</label><!-- ラベリング -->
        </div>
        <div class="message">
          <div>
            <?php foreach ($userInfo as $key => $value) {?>
              <b><?= htmlspecialchars($key)?></b>:<?= htmlspecialchars($value) ?><br>
            <?php } ?>
          </div>
        </div>
      
      <div class="input_form"><!--入力フォームクラス-->
        <form action="user_profile_for_URL_controller.php" method="post" enctype="multipart/form-data"> <!-- Sign_up.phpとやり取りする -->
          <input type="hidden" name="token" value="<?php echo htmlspecialchars($token, ENT_QUOTES); ?>">
          <div>
            <label for="username">ユーザーネーム</label>          <!-- ラベリング -->
            <input type="text" id="username" name="username" required value = "name">  <!-- 入力フォーム　指定する名前　入力を必須化　初期値を追加 -->
          </div>
          <div>
            <label for="userIcon">ユーザーアイコン<br></label>          <!-- ラベリング -->
            <input  type="file" id="userIcon" name="userIcon" accept=".jpg,.jpeg,.png,.gif">  <!-- 入力フォーム　指定する名前　入力を必須化 -->
          </div>
          <div>
            <label for="userbio">自己紹介<br></label>          <!-- ラベリング -->
            <textarea id="userbio" name="userbio" rows="5" cols="40" required > </textarea> <!-- 入力フォーム　指定する名前　入力を必須化 -->
          </div>
         
          <div class="submitArea"> 
            <input type = "submit" name="submitProfile" value = "プロフィール登録" > 
          </div>
        </form>
      </div>
      <form method="post" action="user_profile_for_URL_controller.php">
        <div class="submitArea">
          <input type = "submit" id="Logout" name=Logout value = "ログアウト" > 
       </div>
      </form>
      </div>
      </div>
      </div>
    </div>

</body>
</html>
