<?php
session_start();

require_once __DIR__ . '/../functions.php';
require_once __DIR__ . '/../classes/UserLogic.php';

$result = UserLogic::checkLogin();
if ($result) {
  header('Location: ../staff/index.php');
  return;
}

$err = $_SESSION;

$_SESSION = [];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/style.css">
  <title>スタッフログイン</title>
</head>
<body>
  <h2 class="page-title">スタッフログイン</h2>
  <?php if(isset($err['msg'])): ?>
      <p class="err"><?= h($err['msg']); ?></p>
  <?php endif; ?>
  <form action="./staff_login_complete.php" method="post">
  <p>
    <label for="email">メールアドレス</label>
    <input type="text" name="email" id="email" value="<?= h($err['input_email']); ?>">
    <?php if(isset($err['email'])): ?>
      <p class="form-err"><?= h($err['email']); ?></p>
    <?php endif; ?>
  </p>
  <p>
    <label for="password">パスワード</label>
    <input type="password" name="password" id="password">
    <?php if(isset($err['password'])): ?>
      <p class="form-err"><?= h($err['password']); ?></p>
    <?php endif; ?>
  </p>
  <input type="hidden" name="csrf_token" value="<?= h(setToken()); ?>">
  <p>
    <input class="btn-primary" type="submit" value="ログインする">
  </p>
  </form>
</body>
</html>