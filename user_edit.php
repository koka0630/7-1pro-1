<?php
require_once 'dbconnect.php';
$id =  $_GET['id'];
if(empty($id)){
    exit('IDが不正です');
}

$dbh = connect();

//SQLの準備
$stmt =  $dbh->prepare('SELECT * FROM users Where id = :id');
$stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);

//SQLの実行

$stmt->execute();

//結果を取得
$result =  $stmt->fetch(PDO::FETCH_ASSOC);

if(!$result){
    exit('情報がありません');
}

$id =  $result['id'];
$name = $result['name'];
$email = $result['mail'];
$password =  $result['password'];
$favoriteramen = $result['favorite_ramen'];
$exercise_goal = $result['exercise_goal'];
$created_at= $result['created_at'];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー編集画面</title>
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



 <?php if (isset($login_err)) : ?>
  <p><?php echo $login_err; ?></p>
      <?php endif; ?>

<div class="hensyuu">
<form action=user_update.php method="POST" class="ramenramen"> 
    <input type="hidden" name="id" value="<?php echo $id?>">
    <label for="username">ユーザーネーム:</label>
    <input type="text" name="username" id="username" class="username" value="<?php echo $name?>">
    <br>
    <label for="email">メールアドレス:</label>
    <input type="email" name="email" id="email" class="email" value="<?php echo $email?>" >
    <br>
    <label for="password">パスワード:</label>
    <input type="password" name="password" id="password" class="password"value="<?php echo $password?>" >
    <br>
    <label for="favoriteramen">好きならーめん:</label>
    <input type="text" name="favoriteramen" id="favoriteramen" class="favoriteramen" value="<?php echo $favoriteramen?>">
    <label for="exercisegoal">運動目標:</label>
    <input type="text" name="exercisegoal" id="exercisegoal" class="exercisegoal" value="<?php echo $exercise_goal?>" >
      
        
    <div id="signup">
    <input type="submit" class="sign-btn" value="登録">
    </div>        
</form>
 </div>
</body>
</html>