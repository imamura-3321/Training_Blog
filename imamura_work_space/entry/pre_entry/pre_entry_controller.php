<?php
session_start();

include 'pre_entry_view.php';

print_r($_SESSION);
if($_SERVER['REQUEST_METHOD'] === 'POST') {//ユーザーからのアクションがあった時に起動
    if (isset($_POST['Yes'])) {
    // 「はい」が押された
   
    unset($_SESSION['alreadySend']); //次のページで、初回起動判定に使うセッション変数をリセット
    header("Location: ../send_sign_up_email/send_sign_up_email_controller.php");//該当ページに遷移
    exit;
    }elseif (isset($_POST['No'])) {
    // 「いいえ」が押された
    header("Location: ../sign_up/sign_up_controller.php");//該当ページに遷移
    exit;
}
}
print_r($_SESSION);

//以下関数宣言ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
  function maskPassword($pass){
      $passLen=mb_strlen($pass, 'UTF-8');

      $MP=mb_substr($pass, 0, 1);//パスワードの一文字目だけ抜き出す
      for($loop=1;$loop<$passLen;$loop++){//残りを＊で埋める
        $MP.='*';
      }
      return $MP;
  }