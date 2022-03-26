<?php
require_once 'dbconnect.php';



$search_word = $_POST['word'];
$dbh =  connect();

$sql ="select * from ramens LEFT JOIN users ON ramens.user_id = users.id where kindoframen like '".$search_word."%'";


$sth = $dbh->prepare($sql);
$sth->execute();
$result = $sth->fetchAll();
//if($result){
  //  foreach ($result as $row) {
    //    echo $row['storename']." ";
      //  echo $row['impression'];
      //  echo $row['exercise_comment'];
      //  echo $row['name'];
        

        //echo "<br />";
    //}
//}
//else{
    //echo "投稿がありません";
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="mypage.css">
    <link rel="stylesheet" href="header/header2.css">
    <link rel="stylesheet" href="footer/footer.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>検索結果</title>
</head>

<!-- ====== ヘッダー ======= -->
 <?php
    include("header/header2.php");
  ?>
<body>
    <div class="kensakukekka">
    <h2>検索結果</h2>
<?php foreach($result as $row): ?>
    <img class="kensaku-img" src="<?php echo "{$row['imagepath']}"; ?>" alt="" >
    <br>
    <a>投稿者：</a><td class="postuser"><?php echo "{$row['name']}"; ?></td>
    <br>
    <a>店舗名：</a><td class="store_recommends"><?php echo "{$row['storename']}"; ?></td>
   <br>
   <a>おすすめ度：</a><td><?php echo "{$row['recommends']}"; ?></td>
   <br>
   <a>感想：</a><td ><?php echo "{$row['impression']}"; ?></td>
   <br>
   <a>運動コメント：</a><td ><?php echo "{$row['exercise_comment']}"; ?></td>
   <br>
   <?php endforeach; ?>
     </div>
</body>

 <!-- ====== フッター ======= -->
 <?php
   include("footer/footer.php");
  ?>
</html>