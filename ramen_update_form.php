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

$id =  $result['id'];
$storename = $result['storename'];
$kindoframen = (int)$result['kindoframen'];
$recommends = (int)$result['recommends'];
$price = $result['price'];
$stasion = $result['station'];
$impression = $result['impression'];
$exersizecomment = $result['exercise_comment'];
$imagename =  $result['imagename'];
$imagepath = $result['imagepath'];
$_FILES['uploadfile']['name'] = $imagepath;

?>







<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mypage.css">
    <link rel="stylesheet" href="header/header2.css">
    <link rel="stylesheet" href="footer/footer.css">
    <title>らーめん編集フォーム</title>
</head>
<!-- ====== ヘッダー ======= -->
<?php
    include("header/header2.php");
  ?>
<section>
<body>
 <div class="ramen-edit">
  <h3>らーめんの編集</h3>
  <form enctype="multipart/form-data" action=ramen_update.php method="POST">
      <input type="hidden" name="id" value="<?php echo $id ?>">
  <label for="storename">店舗名:</label>
        <input type="text" name="storename" id="storename" class="storename" value="<?php echo $storename?>">
        <br>
        <label for="kindoframen">らーめんの系統:</label>
        <select name="kindoframen" id="kindoframen" class="kindoframen" >
        <option value="1"<?php if($kindoframen === 1) echo "selected"?>>醤油</option>
        <option value="2"<?php if($kindoframen === 2) echo "selected"?>>塩</option>
        <option value="3"<?php if($kindoframen === 3) echo "selected"?>>味噌</option>
        <option value="4"<?php if($kindoframen === 4) echo "selected"?>>トンコツ</option>
        <option value="5"<?php if($kindoframen === 5) echo "selected"?>>その他</option> 
        </select>
        <br>
        <label for="recommends">おすすめ度:</label>
        <select name="recommends" id="recommends" class="recommends" >
         <option value="1"<?php if($recommends === 1) echo "selected"?>>☆</option>
         <option value="2"<?php if($recommends === 2) echo "selected"?>>☆☆</option>
         <option value="3"<?php if($recommends === 3) echo "selected"?>>☆☆☆</option>
        </select>
        <br>
        <label for="price">値段:</label>
        <input type="text" name="price" id="price" class="price" value="<?php echo $price?>">
        <br>
        <label for="station">最寄駅:</label>
        <input type="text" name="station" id="station" class="station" value="<?php echo $stasion?>">
        <br>
        <label for="impression">感想:</label>
        <br>
        <textarea name="impression" id="impression" class="impression" cols="30" rows="5"><?php echo $impression ?></textarea>
        <br>
        <label for="exercise_comment">運動目標:</label>
        <br>
        <textarea name="exercise_comment" id="exercise_comment" class="exercise_comment" cols="30" rows="5"><?php echo $exersizecomment ?></textarea>
        <br>
        <label for="image">イメージの追加:</label>
        <input type="file" name="image" id="image" class="image" accept="image/png,image/jpeg" value="<?php echo $imagepath ?>">
        
        <br>
        <br>
        <a>現在の画像</a>
        <br>
        <img  src="<?php echo $imagepath?>" alt=""> 
        <br>
        <input type="submit" value="確認">


</form>


</div>

    
</body>
</section>
  <!-- ====== フッター ======= -->
  <?php
   include("footer/footer.php");
  ?>
</html>
