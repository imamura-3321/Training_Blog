<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();
include '../Server_info.php';//サーバー情報をgitignoreで指定したファイルに隔離したのでそこからインクルード
include 'Log_In_model.php';//モデルからDB接続関連を持ってくる

$errorMessage = "";//エラーメッセージを初期化 Sign_up_viewで使用する変数のため、先に宣言しないと読み込みエラーを吐く
$result;//実行結果
   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {//ユーザーからのアクションがあった時に起動
        $errorMessage = "";

        if(isset($_POST['Login'])) {

            $inName = $_POST['username'];//受けっとった入力を変数に渡す

            $inPass = $_POST['pass'];


            $errorMessage = "";//エラーメッセージを初期化
            //$success_message = "";//成功メッセージを初期化

            $dbConnect = new SignUpModel($serverInfo);//データベースに接続するクラスをインスタンス

            $Login=$dbConnect->checkLogin($inName, $inPass);
            if($Login){
            echo "成功";
                $_SESSION['user']=[
                    'username' => $inName,
                    'logged_in' => true,];
            header("Location: ../User_page/User_profile/User_profile_controller.php");//該当ページに遷移ト
            exit;

        }else{
         $errorMessage = "入力内容が違います";
        }

         

        //header("Location: ../Pre_entry/Pre_entry_controller.php");//該当ページに遷移
       // exit;
    }
   
    }
        
    

include 'Log_In_view.php';

   

   
   


  ?>
