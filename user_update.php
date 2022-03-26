<?php
session_start();

require_once 'UserLogic.php';
$users = $_POST;


// エラーメッセージ

$err = [];

//$token = filter_input(INPUT_POST, 'csrf_token');
//トークンがない、もしくは一致しない場合、処理を中止
//if(!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']){
 ///  exit('不正なリクエスト');
//}

//unset($_SESSION['csrf_token']);

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
 userUpdate($users);

?>

<a href="mypage.php">マイページへ</a>