<?php
if(!isset($_SESSION)){
    session_start();
}

require_once 'UserLogic.php';
require_once 'functions.php';



//ログインしているかを判定し、していなかったら新規登録画面へ返す
$result = UserLogic::checkLogin();

if (!$result){
   $_SESSION['login_err'] =  'ユーザーを登録してログインしてください';
   return;
}
$login_user =  $_SESSION['login_user'];

$my_ramens = getMyRamen($_SESSION['login_user']['id']);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ</title>
    <link rel="stylesheet" href="mypage.css">
    <link rel="stylesheet" href="header/header2.css">
    <link rel="stylesheet" href="footer/footer.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/mypage.js"></script>
</head>
 <!-- ====== ヘッダー ======= -->
 <?php
    include("header/header2.php");
  ?>
<body>
 
<section>
<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
  <div class="infomation">
   <h2>アカウント情報</h2>
   <p>ログインユーザー:<?php echo h($login_user['name']) ?></p>
   <p>メールアドレス:<?php echo h($login_user['mail']) ?></p>
   <p>好きならーめん:<?php echo h($login_user['favorite_ramen']) ?></p>
   <p>運動目標:<?php echo h($login_user['exercise_goal']) ?></p>

   <a href="user_edit.php?id=<?php echo h($login_user['id']) ?> " class="edit-btn">編集する</a>
   <a href="user_delete.php?id=<?php echo h($login_user['id']) ?> " id="delete-btn" onclick="return confirm('本当に削除しますか?')">このアカウントを削除する</a>
    

   </div>
  <br>
  <div class="title">
 <h3><?php echo h($login_user['name']) ?>さんのらーめん日記</h3>
 <br>
   <a href="ramen.php" class="post-btn">ラーメンを追加する</a>
  </div>
   </section>

   <br>
   <div class="myramens">
   <?php foreach($my_ramens as $my_ramen): ?>
      
    <img class="myramen-img" src="<?php echo "{$my_ramen['imagepath']}"; ?>" alt="">
   
   <td>店名：<?php echo "{$my_ramen['storename']}"; ?></td>
   <br>
   <td>おすすめ度：<?php echo "{$my_ramen['recommends']}"; ?></td>
   <br>
   <td><a href="detail.php?id=<?php echo "{$my_ramen['id']}"; ?>" class="detail-btn">もっと見る</a></td>

   
   <?php endforeach; ?>

   </div>

   


   
 
</body>
   <!-- ====== フッター ======= -->
 <?php
   include("footer/footer.php");
  ?>
</html>