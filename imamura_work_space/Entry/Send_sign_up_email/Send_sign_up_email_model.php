<?php
   include '../../Server_info.php';//サーバー情報をgitignoreで指定したファイルに隔離したのでそこからインクルード
    
   class SignUpModel {
      

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


        public function addpreUser($username,$password,$email,$token,$userStatus){//仮登録時にデータベースに渡す
           
            try {
           $sql = "INSERT INTO login_test  (user_name, login_pw,  email_address,token, user_status, created_user)
                              VALUES (:username, :login_pw,:email_address,:token,:user_status, :created_user)";//クエリを作成　ユーザーネームに被りがないかの確認 SQLインジェクション対策でプリペアドステートメント 
            
            $stmt = $this->dbh->prepare($sql);//PDOオブジェクトにクエリを渡して準備させる　prepare関数はPODステートメントオブジェクトが返される
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);//プレースホルダに値をセット　プレースホルダ名 　入れたい名前　渡す型の指定　
            $stmt->bindValue(':login_pw', $password, PDO::PARAM_STR);
            $stmt->bindValue(':email_address', $email, PDO::PARAM_STR);
             $stmt->bindValue(':token',$token, PDO::PARAM_STR);
            $stmt->bindValue(':user_status',$userStatus, PDO::PARAM_INT);
            $stmt->bindValue(':created_user', $username, PDO::PARAM_STR);
          
            $stmt->execute();//準備したクエリを実行
                }catch (PDOException $e) {//エラー表示
                die("接続エラー: " . $e->getMessage());
            }
        }
  
    }

?>
