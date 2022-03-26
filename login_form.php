<?php

session_start();

require_once 'UserLogic.php';

$result =  UserLogic::checkLogin();
if ($result){
  return;
}

$err = $_SESSION;

//セッションを消す
$_SESSION = array();
session_destroy();


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="header/header.css">
    <link rel="stylesheet" href="footer/footer.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="login.js"></script>
    <script src="header/header.js"></script>
    
</head>

<body>
    <!-- ====== ヘッダー ======= -->
  <?php
    include("header/header.php");
  ?>
<section>
<!-- ====== 画像 ======= -->
<div id="login-img">
    <img class="login-img" src="img/ramen.png" alt="ramen">
  </div>

  <?php if (isset($err['msg'])) : ?>
            <p><?php echo $err['msg']; ?></p>
            <?php endif; ?>
    
<form action=login.php method="POST"> 
        
        <label for="email">メールアドレス：</label>
        <input type="email" name="email" id="email" class="email"  value="">
        <?php if (isset($err['email'])) : ?>
            <p><?php echo $err['email']; ?></p>
            <?php endif; ?>
        <br>
        <label for="password">パスワード:</label>
        <input type="password" name="password" id="password"  class="password" value="">
        <?php if (isset($err['password'])) : ?>
            <p><?php echo $err['password']; ?></p>
            <?php endif; ?>
        <br>
        <button type="submit" class="login-btn">ログイン</button>
</form>

<div id="signup">
<img class="azitama-img1" src="img/azitama.png" alt="azitama-img1">
<div class="signup-btn">
        <a href="signup.php">新規アカウント作成</a>
</div>
<img class="azitama-img2" src="img/azitama.png" alt="azitama-img2">
</div>


<a href="passwordup.php" class="passwordup">パスワードをお忘れの方はこちら</a>
</section>
 <!-- ====== フッター ======= -->
 <?php
   include("footer/footer.php");
  ?>
</body> 

</html>