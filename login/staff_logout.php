<?php
session_start();
require_once __DIR__ . '/../classes/UserLogic.php';

if (!$logout = filter_input(INPUT_POST, 'logout')) {
  exit('不正なリクエストです');
}

$result = UserLogic::checkLogin();
if (!$result) {
  exit('セッションが切れましたので、ログインし直してください。<a class="btn-primary" href="staff_login.php">ログイン画面へ</a>');
}

UserLogic::logout();


?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/style.css">
  <title>ログアウト 完了画面</title>
</head>
<body>
  <h2 class="page-title">ログアウト 完了画面</h2>
  <p class="result">ログアウトしました。</p>
  <a class="btn-primary" href="staff_login.php">ログイン画面へ</a>
</body>
</html>
