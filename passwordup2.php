<?php
require_once 'dbconnect.php';
$passwordup = $_POST['mail'];
$errmessage =  array();


if(empty($passwordup)){
     echo 'メールアドレスを入力してください';
    }


//入力されたメールアドレスがデータベースにあるか
$dbh = connect();

$stmt =  $dbh->prepare('SELECT * FROM users Where mail = :mail');
$stmt->bindValue(':mail', $passwordup, PDO::PARAM_STR);

$stmt->execute();
$result = $stmt->fetchAll();

if(!$result){
    echo "投稿がありません";
  }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード再設定メール送信</title>
</head>
<body>
   <h2>メール送信が完了しました</h2>
   パスワード再設定用のURLをメールアドレスに送信しました。<br>
   
   <a href="login.php" >ログイン画面へ</a>
    
</body>
</html>