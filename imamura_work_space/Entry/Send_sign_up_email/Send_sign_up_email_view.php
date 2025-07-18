<?php
 require_once 'Send_sign_up_email_controller.php';
 ?>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pre_entry</title>
   <link rel="stylesheet" href="Send_sign_up_email_view.css">
</head>

<body>
    <h1>〇〇ブログ</h1>
    
    <div class="main_area"><!--仮登録-->
      <div class="subhead">
        <label for="meil">メールアドレス</label><!-- ラベリング -->
        <div class="subheadText">
          <span><?php echo htmlspecialchars($_SESSION['mail'] ,ENT_QUOTES, 'UTF-8');?></span><!-- セッションで渡された値を表示 -->   
        </div>
      </div>
      
      <div class="message">
        <span>上記のメールアドレスに<br>本登録用の確認リンクをお送りしました。
              <br>メールをご確認いただき、<br>リンクをクリックして登録を完了してください。
        </span> <!-- セッションで渡された値を表示 -->   
      </div>
      <form action="Send_sign_up_email_controller.php" method="post"> <!-- Pre_entry_controller.phpとやり取りする -->
        <div class="reSend">
            <input type = "submit" name="reSend" value = " 再度送信 " > 
        </div>
      </form>
      <div>
       
        <a href=<?php echo $sendURL;?>>URL</a>
      <div>
    </div>
      

</body>
</html>
