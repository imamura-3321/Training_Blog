<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();
//include '../../server_info.php';//サーバー情報をgitignoreで指定したファイルに隔離したのでそこからインクルード



include '../../server_info.php';//サーバー情報をgitignoreで指定したファイルに隔離したのでそこからインクルード
include 'user_profile_confirm_model.php';//モデルからDB接続関連を持ってくる
$token=$_GET['token'] ?? $_SESSION['token'] ??null; 

$baseDir='../../images/'; 

  


  if(isset($_SESSION['user']['logged_in'])&& $_SESSION['user']['logged_in'] ==true){//ログイン状態を示すセッションが存在し、真の場合、ログインページに飛ばす
    echo "2";
    $username=$_SESSION['form']['username'];
    $dbConnect = new confilmModel($serverInfo);//データベースに接続するクラスをインスタンス
    $userInfo=$dbConnect->GetUserInfo($token);
    $userId = $userInfo['id'];

     $file = $_SESSION['form']['file'];
     $faileName=$_SESSION['form']['file']['name'];
     $userName = $_SESSION['form']['username'];
     $userBio=$_SESSION['form']['userbio'];
     $imagePass=    $_SESSION['imagepass'];

   


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Yes'])) {
    echo "333333333333";
      $userDir=$baseDir .'/User'. $userId;//保存するフォルダパス
      if(!is_dir($userDir)){//保存するフォルダを作成
         if(!mkdir($userDir, 0755, true)){
            die('ユーザーフォルダの作成に失敗しました。');
         }
      }   
      echo $userDir;
      $savePath = $userDir .'/'.basename($file['name']);


      if (rename($imagePass, $savePath)) {
        
        echo "アップロード成功！<br>";
        echo "保存先: " . htmlspecialchars($savePath);
        $dbConnect->addUserProfile(
        $_SESSION['user']['username'],//変化前のユーザー名
        $userName,    // 入力されたユーザー名
        $savePath,             // 画像のパス
        $userBio      // 自己紹介
      );
      } else {
          error_log("move_uploaded_file失敗 tmp_name={$file['tmp_name']} savePath=$savePath");
        die('ファイルの保存に失敗しました。');
      }


    }




  }else{
    session_unset();//セッションを終了
    header('Location: ../../log_in/log_in_controller.php');
    exit;
  }









include 'user_profile_confirm_view.php';
?>



