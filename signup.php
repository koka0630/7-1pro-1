<?php
session_start();

require_once 'functions.php';
require_once 'UserLogic.php';

$result =  UserLogic::checkLogin();
if ($result) {
  header('Location: mypage.php');
  return;
}

$login_err = isset($_SESSION['login_err']) ? $_SESSION['login_err'] : null;
unset($_SESSION['login_err']);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録画面</title>
    <link rel="stylesheet" href="signup.css">
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
<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
<!-- ====== 画像 ======= -->
<section>
  <h2>新規登録</h2>
<div id="signup-img">
    <img class="signup-img" src="img/ramen.png" alt="ramen">
  </div>
    <?php if (isset($login_err)) : ?>
      <p><?php echo $login_err; ?></p>
      <?php endif; ?>


<form action=register.php method="POST"> 
    
        <label for="username">ユーザーネーム:</label>
        <input type="text" name="username" id="username" class="username" >
        <br>
        <label for="email">メールアドレス:</label>
        <input type="email" name="email" id="email" class="email" >
        <br>
        <label for="password">パスワード:</label>
        <input type="password" name="password" id="password" class="password" >
        <br>
        <label for="favorite-ramen">好きならーめん:</label>
        <input type="text" name="favorite-ramen" id="favorite-ramen" class="favorite-ramen" >
        <label for="exercise-goal">運動目標:</label>
        <input type="text" name="exercise-goal" id="exercise-goal" class="exercise-goal" >
      
        
      
        <div id="signup">
        <img class="tya-shuu-img1" src="img/tya-shuu.png" alt="tya-shuu-img1">
        <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
        <input type="submit" class="sign-btn" value="登録">
        <img class="tya-shuu-img2" src="img/tya-shuu.png" alt="tya-shuu-img2">
        </div>        
</form>


</section>
 <!-- ====== フッター ======= -->
 <?php
   include("footer/footer.php");
  ?>
</body>

</html>