<?php
session_start();

require_once __DIR__ . '../functions.php';

$err = $_SESSION;

$_SESSION = [];
session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>スタッフログイン</title>
</head>
<body>
  <h2>スタッフログイン</h2>
  <?php if(isset($err['msg'])): ?>
      <p><?= $err['msg']; ?></p>
  <?php endif; ?>
  <form action="./staff_login_complete.php" method="post">
  <p>
    <label for="email">メールアドレス</label>
    <input type="text" name="email" id="email">
    <?php if(isset($err['email'])): ?>
      <p><?= $err['email']; ?></p>
    <?php endif; ?>
  </p>
  <p>
    <label for="password">パスワード</label>
    <input type="password" name="password" id="password">
    <?php if(isset($err['password'])): ?>
      <p><?= $err['password']; ?></p>
    <?php endif; ?>
  </p>
  <input type="hidden" name="csrf_token" value="<?= h(setToken()); ?>">
  <p>
    <input type="submit" value="ログインする">
  </p>
  </form>
</body>
</html>