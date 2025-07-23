<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();
//include '../../server_info.php';//サーバー情報をgitignoreで指定したファイルに隔離したのでそこからインクルード



include '../../server_info.php';//サーバー情報をgitignoreで指定したファイルに隔離したのでそこからインクルード
include 'user_profile_for_URL_model.php';//モデルからDB接続関連を持ってくる
$token=$_GET['token'] ?? $_SESSION['token'] ?? null; 

$baseDir='../../images/'; 
$inName=$_SESSION['name'];

$baseDir='../../images/tmp_uploads'; 

  if($token !== null){//URLにトークンがあるときの処理
    
    
    $_SESSION['token']=$token;
    $dbConnect = new JudgeLoginTokenModel ($serverInfo);//データベースに接続するクラスをインスタンス
    $userInfo=$dbConnect->GetUserInfo($token);
    $_SESSION['user']=[//ログイン状態に遷移
                    'username' => $inName,
                    'logged_in' => true,];

    

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {//ボタンを押したとき

      $file = $_FILES['userIcon'];//アップロードされたファイル情報を取得
      if ($file['error'] !== UPLOAD_ERR_OK) {//アップロードエラーのチェック
        die('アップロードエラー: ' . $file['error']);
      }

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];// 許可する拡張子とMIMEタイプの指定
        $allowedMimes = ['image/jpeg', 'image/png', 'image/gif'];

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));//アップロードファイルの拡張子・MIMEタイプの取得
        $mime = mime_content_type($file['tmp_name']);

    if (!in_array($ext, $allowedExtensions) || !in_array($mime, $allowedMimes)) {//拡張子・MIMEタイプの検証
        die('許可されていないファイル形式です。');
    } 
      

       $savePath=realpath($baseDir).'/'. $file['name'];

     
       move_uploaded_file($file['tmp_name'], $savePath);


       

        $_SESSION['form'] = [   // テキスト情報をセッションに保存
        'username'  => $_POST['username'] ?? '',
        'userbio'   => $_POST['userbio'] ?? '',
        ];
    
        $_SESSION['form']['file'] = $_FILES['userIcon'];// ファイル情報も保存
     
         $_SESSION['imagepass']=$savePath;
        header('Location: ../user_profile_confirm/user_profile_confirm_controller.php');
    }

  }else{
    echo "dame";
    session_unset();//セッションを終了
    header('Location: ../../log_in/log_in_controller.php');
    exit;
  }

  

include 'user_profile_for_URL_view.php';
?>



