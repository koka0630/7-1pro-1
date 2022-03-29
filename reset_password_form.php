<?php
session_start();
require_once 'dbconnect.php';
require_once 'UserLogic.php';
$err = $_SESSION;

$url_pass = parse_url($_SERVER['REQUEST_URI']);
//tmp_key=kfjdsabfjabsdj
parse_str($url_pass['query'],$queryparams);


$tmp_key = $queryparams['tmp_key'];

$current_user = UserLogic::getUserByTmpKey($tmp_key);



if (!$current_user){
 throw new Exception('無効なurlです');
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード再設定</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="header/header.css">
    <link rel="stylesheet" href="footer/footer.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="reset_password_form.js"></script>
    <script src="header/header.js"></script>
    
</head>

<body>
    <!-- ====== ヘッダー ======= -->
  <?php
    include("header/header.php");
  ?>
<section>
<!-- ====== 画像 ======= -->
<div id="reset_password-img">
    <img class="reset_password-img" src="img/ramen.png" alt="ramen">
  </div>

  <?php if (isset($err['msg'])) : ?>
            <p><?php echo $err['msg']; ?></p>
            <?php endif; ?>
    
<form action=reset_password.php method="POST"> 
        <input type="hidden" name="email" id="email"  class="email" value="<?php echo $current_user['mail']?>">
        <label for="password">新しいパスワード:</label>
        <input type="password" name="password" id="password"  class="password" value="">
        <?php if (isset($err['password'])) : ?>
            <p><?php echo $err['password']; ?></p>
            <?php endif; ?>
        <br>
        <button type="submit" class="reset_password-btn">送信</button>
</form>

</section>
 <!-- ====== フッター ======= -->
 <?php
   include("footer/footer.php");
  ?>
</body> 

</html>