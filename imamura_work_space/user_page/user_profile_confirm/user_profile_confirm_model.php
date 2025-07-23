<?php

   include '../../server_info.php';//サーバー情報をgitignoreで指定したファイルに隔離したのでそこからインクルード
    
   class confilmModel {
      

        public $dbh;
        
        public function __construct($serverInfo) {
            $dsn = "mysql:host={$serverInfo['host']};port={$serverInfo['port']};dbname={$serverInfo['dbname']};charset={$serverInfo['charset']}";
            $this->dbh = null; 
            
            try {
                $this->dbh = new PDO($dsn, $serverInfo['user'],$serverInfo['pass']);//データベース接続用インスタンス作成
                $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//エラーモード指定
            }catch (PDOException $e) {//エラー表示
                die("接続エラー: " . $e->getMessage());
            }
        }


        public function GetUserInfo($token){//仮登録時にデータベースに渡す
           
          try {
            $sql = "SELECT id ,user_name ,email_address ,created_user  FROM login_test WHERE token =:token";//クエリを作成　ユーザーネームに被りがないかの確認 SQLインジェクション対策でプリペアドステートメント 
            
            


            $stmt = $this->dbh->prepare($sql);//PDOオブジェクトにクエリを渡して準備させる　prepare関数はPODステートメントオブジェクトが返される
            $stmt->bindValue(':token', $token, PDO::PARAM_STR);//プレースホルダに値をセット　プレースホルダ名 　入れたい名前　渡す型の
          
            $stmt->execute();//準備したクエリを実行
            $result = $stmt->fetch(PDO::FETCH_ASSOC); 
            return $result;

          }catch (PDOException $e) {//エラー表示
          die("接続エラー: " . $e->getMessage());
          }
        }

          public function addUserProfile($username,$inputUsername,$user_icon,$user_bio){//ユーザープロフィールを追加
           
            try {
           $sql = $sql = "UPDATE login_test SET user_name = :inputUsername, user_icon = :user_icon, user_bio = :user_bio,  updated_date = NOW(),        updated_user=:updated_user
            WHERE user_name = :username"; //クエリを作成　ユーザーネームに被りがないかの確認 SQLインジェクション対策でプリペアドステートメント 
            
            $stmt = $this->dbh->prepare($sql);//PDOオブジェクトにクエリを渡して準備させる　prepare関数はPODステートメントオブジェクトが返される
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);//プレースホルダに値をセット　プレースホルダ名 　入れたい名前　渡す型の指定　
            
            $stmt->bindValue(':inputUsername', $inputUsername, PDO::PARAM_STR);
            $stmt->bindValue(':user_icon', $user_icon, PDO::PARAM_STR);
            $stmt->bindValue(':user_bio', $user_bio, PDO::PARAM_STR);
            $stmt->bindValue(':updated_user', $username, PDO::PARAM_STR);
          
            $stmt->execute();//準備したクエリを実行
                }catch (PDOException $e) {//エラー表示
                die("接続エラー: " . $e->getMessage());
            }
        }        
  
    }

?>

