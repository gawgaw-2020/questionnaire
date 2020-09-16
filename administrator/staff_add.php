<?php
session_start();
require_once __DIR__ . '/../functions.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/style.css">
  <title>スタッフ新規登録</title>
</head>
<body>
  <h2>スタッフ新規登録</h2>
  <a href="./index.php">スタッフ一覧へ</a>
  <form action="./staff_add_complete.php" method="post">
  <p>
    <label for="name">名前</label>
    <input type="text" name="name" id="name">
  </p>
  <p>
    <label for="email">メールアドレス</label>
    <input type="text" name="email" id="email">
  </p>
  <p>
    <label for="password">パスワード</label>
    <input type="password" name="password" id="password">
  </p>
  <p>
    <label for="password_conf">確認用パスワード</label>
    <input type="password" name="password_conf" id="password_conf">
  </p>
  <input type="hidden" name="csrf_token" value="<?= h(setToken()); ?>">
  <p>
    <input type="submit" value="登録する">
  </p>
  </form>
</body>
</html>