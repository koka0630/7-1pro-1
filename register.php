<?php
session_start();

require_once 'UserLogic.php';
// エラーメッセージ

$err = [];

$token = filter_input(INPUT_POST, 'csrf_token');
//トークンがない、もしくは一致しない場合、処理を中止
if(!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']){
   exit('不正なリクエスト');
}

unset($_SESSION['csrf_token']);

// バリデーション
if(!$username =  filter_input(INPUT_POST, 'username')){
   $err[] = 'ユーザー名を記入してください';
}
if(!$email =  filter_input(INPUT_POST, 'email')){
    $err[] = 'メールアドレスを記入してください';
 }
 $password =  filter_input(INPUT_POST, 'password');
 //正規表現
 if(!preg_match("/\A[a-z\d]{8,100}+\z/i",$password)){
  $err[] =  'パスワードは英数字8文字以上100文字以下にしてください';
 }

 if(!$favoriteramen =  filter_input(INPUT_POST, 'favorite-ramen')){
    $err[] = '好きならーめんを記入してください';
 }

 if(!$exercisegoal =  filter_input(INPUT_POST, 'exercise-goal')){
    $err[] = '運動目標を記入してください';
 }


 if(count($err) === 0){
  $hasCreated = UserLogic::createUser($_POST);

    if(!$hasCreated){
        $err[] = '登録に失敗しました';
    }
 }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="header/header.css">
    <link rel="stylesheet" href="footer/footer.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録完了画面</title>
</head>
<!-- ====== ヘッダー ======= -->
<?php
    include("header/header.php");
  ?>
<body>
    <?php if (count($err) > 0):?>
    <?php foreach($err as $e) :?>
    <p><?php echo $e ?></p>
    <?php endforeach ?>

    <?php else : ?>
    <p>ユーザー登録が完了しました</p>

    <?php endif ?>
<a href="./signup.php">戻る</a>   
<a href="./login_form.php">ログイン画面へ</a>
    
</body>
 <!-- ====== フッター ======= -->
<?php
   include("footer/footer.php");
  ?>
</html>