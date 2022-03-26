<?php
mb_language("ja");
mb_internal_encoding("UTF-8");
$header = "From: mizohata.sayaka@gmail.com\n";
if(mb_send_mail('smile-sayaka.0528@ezweb.ne.jp' , '練習です', "練習メール送信です\r\n次の行", $header))
{
echo 'メール送信成功です';
}else{
    echo 'メール送信失敗です';
}


?>