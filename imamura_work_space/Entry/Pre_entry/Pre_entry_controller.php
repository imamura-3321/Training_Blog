<?php
session_start();

include 'Pre_entry_view.php';


if($_SERVER['REQUEST_METHOD'] === 'POST') {//ユーザーからのアクションがあった時に起動
    if (isset($_POST['Yes'])) {
    // 「はい」が押された
    header("Location: ../Pre_entry/Pre_entry_controller.php");//該当ページに遷移
    exit;
    }elseif (isset($_POST['No'])) {
    // 「いいえ」が押された
    header("Location: ../Sign_up/Sign_up_controller.php");//該当ページに遷移
    exit;
}
}


//以下関数宣言ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
  function maskPassword($pass){
      $passLen=mb_strlen($pass, 'UTF-8');

      $MP=mb_substr($pass, 0, 1);//パスワードの一文字目だけ抜き出す
      for($loop=1;$loop<$passLen;$loop++){//残りを＊で埋める
        $MP.='*';
      }
      return $MP;
  }