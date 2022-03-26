<?php
session_start();
require_once 'UserLogic.php';

if (!$logout =  filter_input(INPUT_POST, 'logout'))
{
  exit('不正なリクエストです');
}


//ログインしているかを判定し、セッションが切れていたらログインしてくださいとメッセージを出す
$result = UserLogic::checkLogin();

if (!$result) {
  exit('セッションが切れましたので、ログインしなおしてください');
}

//ログアウトする
UserLogic::logout();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="header/header.css">
    <link rel="stylesheet" href="footer/footer.css">
    <title>ログアウト</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 
</head>

<?php
    include("header/header.php");
  ?>
<body>
<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
<div class="logout-meg">
  <div class="logout-info">
   <h2>ログアウト完了</h2>
   <p>ログアウトしました</p>

   <a href="login_form.php">ログイン画面へ</a>
</div>
   
</div>



</body>
 <!-- ====== フッター ======= -->
 <?php
   include("footer/footer.php");
  ?>
</html>