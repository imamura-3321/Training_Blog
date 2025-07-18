<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();
include '../../Server_info.php';//サーバー情報をgitignoreで指定したファイルに隔離したのでそこからインクルード
include 'Sign_up_model.php';//モデルからDB接続関連を持ってくる

$errorMessage = "";//エラーメッセージを初期化 Sign_up_viewで使用する変数のため、先に宣言しないと読み込みエラーを吐く
$result;//実行結果
   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {//ユーザーからのアクションがあった時に起動
        
        $inName = $_POST['username'];//受けっとった入力を変数に渡す
        $inEmail = $_POST['emailAddress'];
        $inPass = $_POST['pass'];
        $inPassRe = $_POST['passRe'];
        

       
       
        if(signUpJudge($inName,$inPass,$inPassRe,$inEmail,$errorMessage,$serverInfo)){//新規登録認証){
            
            $_SESSION['name'] = $inName;//セッションに値を保存 
            $_SESSION['pass'] = $inPass;
            $_SESSION['mail'] = $inEmail;

            header("Location: ../Pre_entry/Pre_entry_controller.php");//該当ページに遷移
            exit;
       
        }
        
    }

include 'Sign_up_view.php';

    function signUpJudge($inName, $inPass,$inPassRe, $inEmail, &$errorMessage, $serverInfo) {//新規作成判定用関数
    
        $errorMessage = "";//エラーメッセージを初期化
        //$success_message = "";//成功メッセージを初期化

        $dbConnect = new SignUpModel($serverInfo);//データベースに接続するクラスをインスタンス
        $count=$dbConnect->checkUserNameExists($inName);

       
        $results = [];
        $results = [
                    'username' => ['judge' => null, 'message' => ''],//判定用の連想配列
                    'mail'     => ['judge' => null, 'message' => ''],
                    'passRe'  => ['judge' => null, 'message' => ''],//パスワードの確認用との一致確認
                    'password' => ['judge' => null, 'message' => ''],//パスワードのバリデーション判定
                ];
        
        nameJudge($inName,$count,$results);//ユーザーネーム確認
        mailJudge($inEmail,$results);
        passJudge($inPass,$inPassRe,$results);
   
        
        $allTrue = true;//すべての条件が通過したかの判定用
        foreach($results as $key=>$value){//配列を回して、一つも失敗がないか判定
            if ($value['judge'] === false) {
             $errorMessage.= $value['message'] ."\n";//エラーメッセージに追記
             $allTrue=false;
            }
        }

        if( $allTrue== true){//条件通過
            return true;
        }else{
            return false;
        }
    }


    function nameJudge($inName,$count,&$results) {//ユーザーネーム確認
        if($count==0){
            $results['username']=['judge' => true];//判定に判定情報を保存
        } else{
            $results['username']=['judge' => false,'message'=>"名前被り"];//判定に判定情報を保存
        }
    }

     function mailJudge($inEmail,&$results) {//メールアドレス確認

        if (preg_match('/^[a-zA-Z0-9][a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]*@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $inEmail)) {//メールアドレスのバリデーション確認
            $results['mail']=['judge' => true];//判定に判定情報を保存
        } else {
            $results['mail']=['judge' => false,'message'=>"無効なメールアドレスです"];//判定に判定情報を保存
        }
    }

    function passJudge($inPass,$inPassRe,&$results) {//パスワード確認

        if ($inPass === $inPassRe) {//パスワードと確認用パスワードの一致の確認
            $results['passRe']=['judge' => true];//判定に判定情報を保存
        } else {
            $results['passRe']=['judge' => false,'message'=>"パスワード不一致"];//判定に判定情報を保存   
        }

        if (preg_match('/^(?=.*[a-zA-Z])(?=.*\d)[\x21-\x7E]{6,}$/', $inPass)) {//パスワードのバリデーション確認
            $results['password']=['judge' => true];//判定に判定情報を保存
        }else{
            $results['password']=['judge' => false,'message'=>"パスワードは、英字＋数字を含む6文字以上の半角文字列で作成してください"];//判定に判定情報を保存
        }

       
    }

    
   


  ?>
