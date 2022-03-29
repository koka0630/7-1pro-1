<?php
require_once 'dbconnect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// 設置した場所のパスを指定する
require('PHPMailer/src/PHPMailer.php');
require('PHPMailer/src/Exception.php');
require('PHPMailer/src/SMTP.php');

$passwordup = $_POST['mail'];
$errmessage =  array();


if(empty($passwordup)){
     echo 'メールアドレスを入力してください';
    }


//入力されたメールアドレスがデータベースにあるか
$dbh = connect();

$stmt =  $dbh->prepare('SELECT * FROM users Where mail = :mail');
$stmt->bindValue(':mail', $passwordup, PDO::PARAM_STR);

$stmt->execute();
$result = $stmt->fetchAll();

if(!$result){
    echo "存在しないユーザです。";
  }

// 以下はこの記事を参考にした
// https://qiita.com/ShibuyaKosuke/items/309c0a7d969baf0ea8d1

// コンストラクタ
$mail = new PHPMailer();

// 文字コード
$mail->CharSet = "iso-2022-jp";
$mail->Encoding = "7bit";

// SMTPサーバーを利用する
$mail->IsSMTP();

// デバッグ
// $mail->SMTPDebug = 2;

// SMTPAuthを利用する
$mail->SMTPAuth = true;

// SMTPサーバー
$mail->Host = 'smtp.gmail.com';

// ユーザー名
$sender_email =  getenv('SENDER_EMAIL');
$mail->Username = $sender_email;

// パスワード
$sender_password = getenv('SENDER_PASSWORD'); 
$mail->Password = $sender_password;

// ポート
$mail->Port = 587;

// メールヘッダー文字コード
$mimeheader_encoding = 'JIS';

// 送信者アドレス
$mail->From = getenv('SENDER_EMAIL');

// 送信者名
$mail->FromName = mb_encode_mimeheader(
    'ラーメンまん'
    , $mimeheader_encoding
);

// 宛先
$receiver_email = $passwordup;
$mail->addAddress($receiver_email);

// メールタイトル
$mail->Subject = mb_encode_mimeheader(
    '[ramen site] パスワード再設定用メール'
    , $mimeheader_encoding
);

// メール本文
$tmp_key=md5(uniqid(rand(),true));
$SERVER_URL="localhost";
$reset_password_url = "http://$SERVER_URL/reset_password_form.php?tmp_key=$tmp_key";
$mail->Body = mb_convert_encoding(
    "パスワードの再設定用url: $reset_password_url"
    , $mimeheader_encoding
);

$mail->SMTPSecure = 'tls';

if (!$mail->send()) {
    echo $mail->ErrorInfo;
}
$stmt =  $dbh->prepare("UPDATE users SET tmp_key = :tmp_key WHERE mail = :mail");
$stmt->bindValue(':tmp_key', $tmp_key, PDO::PARAM_STR);
$stmt->bindValue(':mail', $passwordup, PDO::PARAM_STR);

$stmt->execute();
//$result = $stmt->fetchAll();


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="header/header.css">
    <link rel="stylesheet" href="footer/footer.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード再設定メール送信</title>
</head>
  <!-- ====== ヘッダー ======= -->
  <?php
    include("header/header.php");
  ?>
<body>
<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
<div class="mailsousin">
   <h2>メール送信が完了しました</h2>
   <br>
   <a>パスワード再設定用のURLをメールアドレスに送信しました。</a>
       <br>
   
   <a href="login.php" >ログイン画面へ</a>
</div>
</body>
<?php
   include("footer/footer.php");
  ?>
</html>