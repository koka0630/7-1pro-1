<?php
require_once 'dbconnect.php';
$id =  $_GET['id'];

if(empty($id)){
    exit('IDが不正です');
}

$dbh = connect();

//SQLの準備
$stmt =  $dbh->prepare('DELETE FROM ramens Where id = :id');
$stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);

//SQLの実行

$stmt->execute();

//結果を取得


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mypage.css">
    <link rel="stylesheet" href="header/header2.css">
    <link rel="stylesheet" href="footer/footer.css">
    <title>削除完了画面</title>
</head>
<!-- ====== ヘッダー ======= -->
<?php
    include("header/header2.php");
  ?>
<body>
    <h2>らーめんの削除が完了しました</h2>
    
</body>
 <!-- ====== フッター ======= -->
 <?php
   include("footer/footer.php");
  ?>
</html>