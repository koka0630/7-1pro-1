<?php
session_start();
require_once 'dbconnect.php';


// エラーメッセージ 

$err = [];

// バリデーション
$email =  filter_input(INPUT_POST, 'email');
if(!$password =  filter_input(INPUT_POST, 'password')){
    $err['password'] = 'パスワードを記入してください';
}


if(count($err) > 0){
  //エラーがあった場合は戻す
  $_SESSION =  $err;
  header('Location: reset_password_form.php');
  return;
 }

$dbh= connect();
$stmt =  $dbh->query("UPDATE users SET password = '" . password_hash($password,PASSWORD_DEFAULT) . "' WHERE mail = '" . $email . "'");
//$res =  $stmt->fetchall(PDO::FETCH_ASSOC);
$dbh =  null;

if (!$stmt){
  throw new Exception('無効なurlです');
}

 
 
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード設定完了</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="header/header2.css">
    <link rel="stylesheet" href="footer/footer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="reset_password.js"></script>
    <script src="header/header.js"></script>
</head>
<body>

  <!-- ====== ヘッダー ======= -->
  <?php
    include("header/header2.php");
  ?>
<div class="login-info">
<h2>パスワード設定完了</h2>


<a href=login_form.php>ログインページへ</a>   

</div>


<!-- ====== フッター ======= -->
<?php
   include("footer/footer.php");
  ?>

    
</body>
</html>