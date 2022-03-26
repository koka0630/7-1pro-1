<?php
require_once 'dbconnect.php';
$id =  $_GET['id'];
if(empty($id)){
    exit('IDが不正です');
}

$dbh = connect();

//SQLの準備
$stmt =  $dbh->prepare('SELECT * FROM ramens Where id = :id');
$stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);

//SQLの実行

$stmt->execute();

//結果を取得
$result =  $stmt->fetch(PDO::FETCH_ASSOC);

if(!$result){
    exit('投稿がありません');
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="mypage.css">
    <link rel="stylesheet" href="header/header2.css">
    <link rel="stylesheet" href="footer/footer.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>らーめん詳細</title>
</head>

<!-- ====== ヘッダー ======= -->
<?php
    include("header/header2.php");
  ?>
<body>
    <div class="ramen-syousai">
    <h2>らーめん詳細</h2>
    <p>店舗名：<?php echo $result['storename']?> </p>
    <p>らーめんの系統；<?php echo $result['kindoframen']?></p>
    <p>おすすめ度：<?php echo $result['recommends']?></p>
    <p>値段：<?php echo $result['price']?></p>
    <p>最寄駅：<?php echo $result['station']?></p>
    <p>感想：<?php echo $result['impression']?></p>
    <p>運動目標：<?php echo $result['exercise_comment']?></p>
    <img  src="<?php echo $result['imagepath']?>" alt="">
   

    <a href="ramen_update_form.php?id=<?php echo $result['id']?>" >編集</a>
    <a href="ramen_delete.php?id=<?php echo $result['id']?>" >削除</a>
</div>
</body>

 <!-- ====== フッター ======= -->
 <?php
   include("footer/footer.php");
  ?>
</html>




