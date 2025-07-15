<?php
session_start();

include '../Server_info.php';//サーバー情報をgitignoreで指定したファイルに隔離したのでそこからインクルード
  $error_message = "";//エラーメッセージ
  $success_message = "";//成功ーメッセージ

  
    $in_name = $_POST['username'];
    $in_email = $_POST['email_address'];
    $in_pass = $_POST['pass'];
    $in_pass_re = $_POST['pass_re'];
   
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {//ユーザーからのアクションがあった時に起動

     
     Sign_up_judge($in_name,$in_pass, $in_pass_re, $error_message,$success_message);//新規登録認証


 }





   //-----------------------------------------------------------------------
  function Sign_up_judge($in_name, $in_pass,$in_pass_re, &$error_message,&$success_message) {//新規作成判定用関数
    try {
        $error_message = "";//エラーメッセージを初期化
        $success_message = "";//成功メッセージを初期化


        global $dsn, $user, $pass;//グローバル変数を使うと宣言
        $pdo = new PDO($dsn, $user, $pass);//データベース接続用インスタンス作成
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//エラーモード指定
        
        $sql ="SELECT COUNT(*) FROM LoginTest WHERE user_name =:username";//クエリを作成　ユーザーネームに被りがないかの確認 SQLインジェクション対策でプリペアドステートメント 
        $stmt = $pdo->prepare($sql);//PDOオブジェクトにクエリを渡して準備させる　prepare関数はPODステートメントオブジェクトが返される
        $stmt->bindValue(':username',$in_name,PDO::PARAM_STR);//プレースホルダに値をセット　プレースホルダ名 　入れたい名前　渡す型の指定　
        $stmt->execute();//準備したクエリを実行
        $count=$stmt->fetchColumn(); //実行したstmtクエリの実行結果からカラムの値を一つだけ取得

        if($count==0){
           $success_message.= "名前被り無し".$count;
        } else{
            $error_message .= "名前被り".$count;
        }
        if ($in_pass === $in_pass_re) {//パスワードと確認用パスワードの一致の確認
            
             $success_message.=  "パスワード一致";
        } else {
            $error_message .= "パスワード不一致";
        }
        echo "表示". $error_message ."表示";
        if($error_message == ""){
          echo "成功";
        }

    } catch (PDOException $e) {//エラー表示
        die("接続エラー: " . $e->getMessage());
    }
  }




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
        <input type="text" id="username" name="username" required value = "name">  <!-- 入力フォーム　指定する名前　入力を必須化　初期値を追加 -->
      </div>
      <div>
        <label for="email_address">メールアドレス<br></label>          <!-- ラベリング -->
        <input type="email" id="email_address" name="email_address" required >  <!-- 入力フォーム　指定する名前　入力を必須化 -->
      </div>
      <div>
        <label for="pass">パスワード<br></label>          <!-- ラベリング -->
        <input type="password" id="pass" name="pass" required >  <!-- 入力フォーム　指定する名前　入力を必須化 -->
      </div>
      <div>
        <label for="pass_re">パスワード確認<br></label>          <!-- ラベリング -->
        <input type="password" id="pass_re" name="pass_re" required >  <!-- 入力フォーム　指定する名前　入力を必須化 -->
      </div>
      <input type = "submit" value = "送信"> 
    </form>
    <div>
      <label for="username">エラーメッセージ<br></label>          <!-- ラベリング -->
      <p><?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8');  ?></p> <!-- 安全のための変換　エラーメッセージ　クォートで囲む　文字コード -->
    </div>
    <div>
      <label for="username">成功時<br></label>          <!-- ラベリング -->
      <p style="color: red;"><?php echo htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8');  ?></p> <!-- 安全のための変換　エラーメッセージ　クォートで囲む　文字コード -->
    </div>
</body>
</html>











