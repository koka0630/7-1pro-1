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
  <h2>パスワードの再設定が必要となります</h2>
  <a>ご登録されたメールアドレスをご入力いただき、<br>
      受信されたメールの案内にしたがってパスワードの再設定をお願いします</a>
      <br>

<form action=passwordup2.php method="POST"> 
    
        <label for="mail">登録しているメールアドレス:</label>
        <input type="email" name="mail" id="mail" class="mail" >
        <br>
        
        <input type="submit" class="sign-btn" value="再発行">

             
</form>


</section>
 <!-- ====== フッター ======= -->
 <?php
   include("footer/footer.php");
  ?>
</body>

</html>
