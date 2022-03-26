<?php
require_once 'dbconnect.php';
require_once 'UserLogic.php';

$ramenData = getallramen();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="friendspost.css">
    <link rel="stylesheet" href="header/header2.css">
    <link rel="stylesheet" href="footer/footer.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿一覧</title>
</head>
<body>
     <!-- ====== ヘッダー ======= -->
 <?php
    include("header/header2.php");
  ?>
  <section>
    <h2>最近の投稿</h2>

    <form action=kensaku.php method="POST">
    <select name="word" id="kindoframen" class="kindoframen" >
        <option value="1">醤油</option>
        <option value="2">塩</option>
        <option value="3">味噌</option>
        <option value="4">トンコツ</option>
        <option value="5">その他</option>
    </select> 

        <input type="submit" value="検索">
        <br>
    </form>

    

   
   <?php foreach($ramenData as $ramen): ?>
    <img src="<?php echo "{$ramen['imagepath']}"; ?>" alt="" class="friendsramen-img">
    <br>
   <a>店舗名：</a><td class="store_recommends"><?php echo "{$ramen['storename']}"; ?></td>
   <br>
   <a>おすすめ度：</a><td ><?php echo "{$ramen['recommends']}"; ?></td>
   <br>
   <a>感想：</a><td ><?php echo "{$ramen['impression']}"; ?></td>
   <br>
   <a>運動コメント：</a><td ><?php echo "{$ramen['exercise_comment']}"; ?></td>
   <br>
   <
   <?php endforeach; ?>


   </section>


    
</body>

  <!-- ====== フッター ======= -->
  <?php
   include("footer/footer.php");
  ?>
</html>