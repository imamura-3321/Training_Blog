<?php

include '../Server_info.php';//サーバー情報をgitignoreで指定したファイルに隔離したのでそこからインクルード



   $inname = $_POST['username'];
   echo $inname."<br>";

   $inpass = $_POST['pass'];
   echo $inpass."<br>";

   $inpass_re = $_POST['pass_re'];
   echo $inpass_re."<br>";

   if($inpass==$inpass_re){
      echo "パスワード一致";
   }else{
      echo "パスワード不一致";
   };



?>


<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign_up</title>
</head>
<body>
    <form action="Sign_up.php" method="post"> <!-- Sign_up.phpとやり取りする -->
      <div>
        <label for="username">ユーザーネーム<br></label>          <!-- ラベリング -->
          <input type="text" id="username" name="username" required value = "name">  <!-- 入力フォーム　指定する名前　入力を必須化 -->
      </div>
      <div>
        <label for="pass">パスワード<br></label>          <!-- ラベリング -->
          <input type="password" id="pass" name="pass" required value = "パス">  <!-- 入力フォーム　指定する名前　入力を必須化 -->
      </div>
      <div>
        <label for="pass_re">パスワード確認<br></label>          <!-- ラベリング -->
          <input type="password" id="pass_re" name="pass_re" required value = "パス">  <!-- 入力フォーム　指定する名前　入力を必須化 -->
          
      </div>
      <input type = "submit" value = "送信"> 
    </form>
 

</body>
</html>











