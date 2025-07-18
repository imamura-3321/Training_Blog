<?php
session_start();

include 'Send_sign_up_email_model.php';//モデルからDB接続関連を持ってくる

error_reporting(E_ALL);
ini_set('display_errors', 1);
$sendURL="";

  $baceURL="http://localhost/Training_Blog_local/imamura_work_space/User_page/User_profile_for_URL/User_profile_for_URL_controller.php";
            
  //random_bytes(32)で作ったランダムバイト列を　base64_encode()で文字列に変換
  //URLに不要な+ や /をstrtr()関数で-_ に変換　=が混ざるがURLには不要なためrtrim() で除去
  $token= rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
  $sendURL=$baceURL.'?'.$token;

  
  if(!isset($_SESSION['alreadySend'])){

             $hashedPass=password_hash($_SESSION['pass'], PASSWORD_DEFAULT);//パスワードをハッシュ化して保存
             $name = $_SESSION['name'];//セッションに値を保存 
             $mailAddress = $_SESSION['mail'] ;
     
            
           
            $dbConnect = new SignUpModel($serverInfo);//データベースに接続するクラスをインスタンス
            $dbConnect->addpreUser($name,$hashedPass,$mailAddress,$token,0);//最後の０はユーザーステータスで仮登録を示す
               
    
            $_SESSION['alreadySend']=true;
         
  }
        
  



 include 'Send_sign_up_email_view.php';

