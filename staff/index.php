<?php
session_start();
require_once __DIR__ . '/../classes/UserLogic.php';
require_once __DIR__ . '/../functions.php';


$result = UserLogic::checkLogin();
if (!$result) {
  $_SESSION['msg'] = 'ログインしてから訪問してください。';
  header ('Location: ../login/staff_login.php');
  exit();
}

$login_user = $_SESSION['login_user'];

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/style.css">
  <title>アンケート画面</title>
</head>
<body>
  <h2>アンケート画面</h2>
  <p>ログインスタッフ：<?= h($login_user['name']); ?></p>
  <p>メールアドレス：<?= h($login_user['email']); ?></p>
  <form action="../login/staff_logout.php" method="post">
    <input type="submit" name="logout" value="ログアウト">
  </form>
</body>
</html>