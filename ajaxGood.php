<?php

require_once 'UserLogic.php';

if(!isset($_SESSION)){
    session_start();
}
  
//ログインしているかを判定し、していなかったら新規登録画面へ返す
$result = UserLogic::checkLogin();

if (!$result){
    $_SESSION['login_err'] =  'ユーザーを登録してログインしてください';
    return;
}

require_once 'function2.php';

// postがある場合
if(isset($_POST['postId'])){
    $p_id = $_POST['postId'];

    try{
        //DB接続
        $dbh = dbConnect();
        // goodテーブルから投稿IDとユーザーIDが一致したレコードを取得するSQL文
        $sql = 'SELECT * FROM good WHERE post_id = :p_id AND user_id = :u_id';
        $data = array(':p_id' => $p_id, 'u_id' => $_SESSION['login_user']['id']);
        // クエリ実行
        $stmt = queryPost($dbh, $sql, $data);
        $resultCount = $stmt->rowCount();
        // レコードが1件でもある場合
        if(!empty($resultCount)){
            // レコードを削除する
            $sql = 'DELETE FROM good WHERE post_id = :p_id AND user_id = :u_id';
            $data = array(':p_id' => $p_id, ':u_id' => $_SESSION['login_user']['id']);
            // クエリ実行
            $stmt = queryPost($dbh, $sql, $data);
            echo count(getGood($p_id));
        }else{
            // レコードを挿入する
            $sql = 'INSERT INTO good (post_id, user_id, created_date) VALUES (:p_id, :u_id, :date)';
            $data = array(':p_id' => $p_id, ':u_id' => $_SESSION['login_user']['id'], ':date' => date('Y-m-d H:i:s'));
            // クエリ実行
            $stmt = queryPost($dbh, $sql, $data);
            echo count(getGood($p_id));
        }
    }catch(Exception $e){
        error_log('エラー発生：'.$e->getMessage());
    }
}

?>