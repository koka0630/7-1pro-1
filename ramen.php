
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="mypage.css">
    <link rel="stylesheet" href="header/header2.css">
    <link rel="stylesheet" href="footer/footer.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>らーめん追加画面</title>
</head>


 <!-- ====== ヘッダー ======= -->
 <?php
    include("header/header2.php");
  ?>

<section>
<body>
<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
<div class="tuika">
  <h3>らーめんの追加</h3>
  <form enctype="multipart/form-data" action=ramen_create.php method="POST">
  <label for="storename">店舗名:</label>
        <input type="text" name="storename" id="storename" class="storename" >
        <br>
        <label for="kindoframen">らーめんの系統:</label>
        <select name="kindoframen" id="kindoframen" class="kindoframen" >
        <option value="1">醤油</option>
        <option value="2">塩</option>
        <option value="3">味噌</option>
        <option value="4">トンコツ</option>
        <option value="5">その他</option>
        </select>
        <br>
        <label for="recommends">おすすめ度:</label>
        <select name="recommends" id="recommends" class="recommends" >
         <option value="1">☆</option>
         <option value="2">☆☆</option>
         <option value="3">☆☆☆</option>
        </select>
        <br>
        <label for="price">値段:</label>
        <input type="text" name="price" id="price" class="price" >
        <br>
        <label for="station">最寄駅:</label>
        <input type="text" name="station" id="station" class="station" >
        <br>
        <label for="impression">感想:</label>
        <br>
        <textarea name="impression" id="impression" class="impression" cols="30" rows="5"></textarea>
        <br>
        <label for="exercise_comment">運動目標:</label>
        <br>
        <textarea name="exercise_comment" id="exercise_comment" class="exercise_comment" cols="30" rows="5"></textarea>
        <br>
        <label for="image">イメージの追加:</label>
        <input type="file" name="image" id="image" class="image" accept="image/png,image/jpeg">
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
