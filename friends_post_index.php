<?php
if(!isset($_SESSION)){
  session_start();
}

require_once 'dbconnect.php';
require_once 'UserLogic.php';
require_once 'function2.php';

//ログインしているかを判定し、していなかったら新規登録画面へ返す
$result = UserLogic::checkLogin();

if (!$result){
   $_SESSION['login_err'] =  'ユーザーを登録してログインしてください';
   return;
}

$ramenData = getallramen();

function check_favolite_duplicate($user_id,$post_id){
  connect();
  $sql = "SELECT *
          FROM good
          WHERE user_id = :user_id AND post_id = :post_id";
  $stmt = $dbh->prepare($sql);
  $stmt->execute(array(':user_id' => $user_id ,
                       ':post_id' => $post_id));
  $favorite = $stmt->fetch();
  return $favorite;
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="friendspost.css">
    <link rel="stylesheet" href="header/header2.css">
    <link rel="stylesheet" href="footer/footer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="good.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>投稿一覧</title>
</head>

<body>
     <!-- ====== ヘッダー ======= -->
 <?php
    include("header/header2.php");
  ?>
  <section>
  <div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
    <h2>最近の投稿</h2>

    <div class="kensakuform">
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
    </div>

    

   
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
   <section class="post" data-postid="<?php echo sanitize($ramen['id']); ?>">
    <div class="btn-good <?php if(isGood($_SESSION['login_user']['id'], getPostData($ramen['id']))) echo 'active'; ?>">
        <!-- 自分がいいねした投稿にはハートのスタイルを常に保持する -->
        <i class="fa-heart fa-lg px-16
        <?php if(isGood($_SESSION['login_user']['id'],$ramen['user_id'])){ //いいね押したらハートが塗りつぶされる
              echo ' active fas';
            }else{ //いいねを取り消したらハートのスタイルが取り消される
                echo ' far';
                }; ?>"></i>
                <span><?php echo count(getGood($ramen['id'])); ?></span>
    </div>
   </section>
  <br>
   <?php endforeach; ?>



   </section>

  


    
</body>

  <!-- ====== フッター ======= -->
  <?php
   include("footer/footer.php");
  ?>
</html>