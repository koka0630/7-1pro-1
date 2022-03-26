<?php
// $to = "youmokakan.220.284@gmail.com";
// $subject = "TEST";
// $message = "This is TEST.\r\nHow are you?";
// $headers = "From: koyamatest42@gmail.com";
// $result = mail($to, $subject, $message, $headers);

ini_set('display_errors', true);
error_reporting(E_ALL);

// require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// 設置した場所のパスを指定する
require('PHPMailer/src/PHPMailer.php');
require('PHPMailer/src/Exception.php');
require('PHPMailer/src/SMTP.php');

// コンストラクタ
$mail = new PHPMailer();

// 文字コード
$mail->CharSet = "iso-2022-jp";
$mail->Encoding = "7bit";

// SMTPサーバーを利用する
$mail->IsSMTP();

// デバッグ
$mail->SMTPDebug = 1;

// SMTPAuthを利用する
$mail->SMTPAuth = true;

// SMTPサーバー
$mail->Host = "smtp.office365.com";//'smtp-mail.outlook.com';

// ユーザー名
$mail->Username = 'kanata.koyama@8r54ls.onmicrosoft.com';

// パスワード
$mail->Password = 'Koyama00';

// ポート
$mail->Port = 587;

// メールヘッダー文字コード
$mimeheader_encoding = 'JIS';

// 送信者アドレス
$mail->From = 'kanata.koyama@8r54ls.onmicrosoft.com';

// 送信者名
$mail->FromName = mb_encode_mimeheader(
    '送信者名'
    , $mimeheader_encoding
);

// 宛先
$mail->addAddress('kanata.koyama@babel.jp');

// メールタイトル
$mail->Subject = mb_encode_mimeheader(
    'メールタイトル'
    , $mimeheader_encoding
);

// メール本文
$mail->Body = mb_convert_encoding(
    '本文'
    , $mimeheader_encoding
);

$mail->SMTPSecure = 'tls';

if (!$mail->send()) {
    echo $mail->ErrorInfo;
}
?>