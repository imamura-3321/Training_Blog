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


        public function checkUserNameExists($username){
            $sql ="SELECT COUNT(*) FROM login_test WHERE user_name =:username";//クエリを作成　ユーザーネームに被りがないかの確認 SQLインジェクション対策でプリペアドステートメント 
            $stmt = $this->dbh->prepare($sql);//PDOオブジェクトにクエリを渡して準備させる　prepare関数はPODステートメントオブジェクトが返される
            $stmt->bindValue(':username',$username,PDO::PARAM_STR);//プレースホルダに値をセット　プレースホルダ名 　入れたい名前　渡す型の指定　
            $stmt->execute();//準備したクエリを実行
            $count=$stmt->fetchColumn(); //実行したstmtクエリの実行結果からカラムの値を一つだけ取得
            return $count; // 結果を返すようにする

        }
  
    }

?>
