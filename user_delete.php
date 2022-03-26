<?php
require_once 'dbconnect.php';
$id =  $_GET['id'];
if(empty($id)){
    exit('IDが不正です');
}

$dbh = connect();

//SQLの準備
$stmt =  $dbh->prepare('DELETE FROM users Where id = :id');
$stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);

//SQLの実行

$stmt->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="header/header.css">
    <link rel="stylesheet" href="footer/footer.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アカウント削除完了画面</title>
</head>


<body>

<!-- ====== ヘッダー ======= -->
<?php
    include("header/header.php");
  ?>
<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
    <h2>アカウントを削除しました</h2>

    
    
</body>
   <!-- ====== フッター ======= -->
   <?php
   include("footer/footer.php");
  ?>


</html>