<?php
session_start();
require_once __DIR__ . '/../classes/UserLogic.php';


$token = filter_input(INPUT_POST, 'csrf_token');
if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
exit('不正なリクエストです');
}

//メールアドレス等を記述したファイルの読み込み
require __DIR__ . '/../mailvars.php'; 

//お問い合わせ日時を日本時間に
date_default_timezone_set('Asia/Tokyo'); 

require_once __DIR__ . '/../functions.php';

$name = h( $_POST[ 'name' ] );
$email = h( $_POST[ 'email' ] );
$satisfaction = h( $_POST[ 'satisfaction' ] );
$message = h( $_POST[ 'message' ] );

//メール本文の組み立て
$mail_body = 'アンケート結果' . "\n\n";
$mail_body = 'お客様より下記の内容で回答を受け付けました。' . "\n\n";
$mail_body .=  "日時： " . date("Y年m月d日 H時i分") . "\n"; 
$mail_body .=  "スタッフ名： " .$name . "\n";
$mail_body .=  "満足度： " .$satisfaction . "\n";
$mail_body .=  "メッセージ： " . $message . "\n\n"  ;
  
//-------- sendmail（mb_send_mail）を使ったメールの送信処理------------

//メールの宛先（名前<メールアドレス> の形式）。値は mailvars.php に記載
$mailTo = mb_encode_mimeheader(MAIL_TO_NAME) ."<" . MAIL_TO. ">";

//Return-Pathに指定するメールアドレス
$returnMail = MAIL_RETURN_PATH; //
//mbstringの日本語設定
mb_language( 'ja' );
mb_internal_encoding( 'UTF-8' );

// 送信者情報（From ヘッダー）の設定
$header = "From: " . mb_encode_mimeheader($yourname) ."<" . $email. ">\n";
$header .= "Cc: " . mb_encode_mimeheader(MAIL_CC_NAME) ."<" . MAIL_CC.">\n";
$header .= "Bcc: <" . MAIL_BCC.">";

//メールの送信（結果を変数 $result に代入）
if ( ini_get( 'safe_mode' ) ) {
  //セーフモードがOnの場合は第5引数が使えない
  $result = mb_send_mail( $mailTo, 'お問い合わせ', $mail_body, $header );
} else {
  $result = mb_send_mail( $mailTo, 'お問い合わせ', $mail_body, $header, '-f' . $returnMail );
}

//メール送信の結果判定
if ( $result ) {
  UserLogic::updateAnswer($email);
  //成功した場合はセッションを破棄
  $_SESSION = array(); //空の配列を代入し、すべてのセッション変数を消去 
  session_destroy(); //セッションを破棄
} else {
  //送信失敗時（もしあれば）
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/style.css">
  <title>アンケート 完了画面</title>
</head>
<body>
  <h2 class="page-title">アンケート 完了画面</h2>
  <p class="result">ご協力ありがとうございました</p>
  <form action="../login/staff_logout.php" method="post">
    <input class="btn-primary" type="submit" name="logout" value="ログアウト">
  </form>
</body>
</html>