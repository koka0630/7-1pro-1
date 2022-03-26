<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード再設定</title>
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


<!-- ====== 画像 ======= -->
<section>
<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
  <h2>パスワードの再設定が必要となります</h2>
  <a class="bunsyou">ご登録されたメールアドレスをご入力いただき、</a><br>
  <a class="bunsyou2">受信されたメールの案内にしたがってパスワードの再設定をお願いします</a>
      <br>

<form action=passwordup2.php method="POST" class="saihakkou"> 
    
        <label for="mail">登録しているメールアドレス:</label>
        <input type="email" name="mail" id="mail" class="mail" >
      
        
        <input type="submit" class="sign-btn" value="再発行">

             
</form>


</section>

</body>
 <!-- ====== フッター ======= -->
 <?php
   include("footer/footer.php");
  ?>
</html>
