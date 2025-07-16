<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../Server_info.php';//サーバー情報をgitignoreで指定したファイルに隔離したのでそこからインクルード
include 'Sign_up_modle.php';//モデルからDB接続関連を持ってくる

$error_message = "";//エラーメッセージを初期化 Sign_up_viewで使用する変数のため、先に宣言しないと読み込みエラーを吐く
$success_message = "";//成功メッセージを初期化

   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {//ユーザーからのアクションがあった時に起動
        
        $in_name = $_POST['username'];//受けっとった入力を変数に渡す
        $in_email = $_POST['email_address'];
        $in_pass = $_POST['pass'];
        $in_pass_re = $_POST['pass_re'];
        
        Sign_up_judge($in_name,$in_pass, $in_pass_re, $in_email,$error_message,$success_message);//新規登録認証
    }

include 'Sign_up_view.php';



    function Sign_up_judge($in_name, $in_pass,$in_pass_re, $in_email, &$error_message,&$success_message) {//新規作成判定用関数
    
     
        
        global $Server_info;//関数内なのでグローバル宣言
        global $error_message;
        global $success_message;

        $error_message = "";//エラーメッセージを初期化
        $success_message = "";//成功メッセージを初期化

        $DB_connect = new SignUpModel($Server_info);//データベースに接続するクラスをインスタンス
        $count=$DB_connect ->check_UserName_Exists($in_name);

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
        

        if (preg_match('/^[a-zA-Z0-9][a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]*@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $in_email)) {
            $success_message.=  "メールアドレス確認";
        } else {
            $error_message .=  "無効なメールアドレスです。";
        }
        if($error_message == ""){
        //echo "成功";
         $_SESSION['name'] = $in_name;
        header("Location: ../Pre_entry/Pre_entry.php");
        exit;
        }

     
    }

  ?>
