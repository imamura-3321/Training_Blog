<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();
include '../../Server_info.php';//サーバー情報をgitignoreで指定したファイルに隔離したのでそこからインクルード
include 'User_profile_model.php';//モデルからDB接続関連を持ってくる


  if(isset($_SESSION['user']['logged_in'])&& $_SESSION['user']['logged_in'] ==true){//ログイン状態を示すセッションが存在し、真の場合、ログインページに飛ばす
    $username=$_SESSION['user']['username'];
    $dbConnect = new LoginModel($serverInfo);//データベースに接続するクラスをインスタンス
    $userInfo=$dbConnect->addpreUser($username);
  }else{
    session_unset();//セッションを終了
    header('Location: ../../Log_In/Log_In_controller.php');
    exit;
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {//ユーザーからのアクションがあった時に起動
        
    
        if(isset($_POST["Logout"])){

          session_unset();//セッションを終了
          header('Location: ../../Log_In/Log_In_controller.php');
          exit;

        }
       
      }
include 'User_profile_view.php';
?>
