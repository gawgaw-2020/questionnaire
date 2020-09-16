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
  <h2 class="page-title">アンケート画面</h2>
  <form action="./confirm.php" method="post">
  <p>
    <label for="name">名前</label>
    <input type="text" name="name" id="name" value="<?= h($login_user['name']); ?>">
  </p>
  <p>
    <label for="email">メールアドレス</label>
    <input type="text" name="email" id="email" value="<?= h($login_user['email']); ?>">
  </p>
  <p>
    <label>あなたは現在の仕事に対して、総合的にどのくらい満足していますか。</label>
    <input type="radio" name="satisfaction" value="good" id="good"><label class="radio-label" for="good">満足</label>
    <input type="radio" name="satisfaction" value="medium" id="medium"><label class="radio-label" for="medium">普通</label>
    <input type="radio" name="satisfaction" value="bad" id="bad"><label class="radio-label" for="bad">不満</label>
  </p>
  <p>
    <label for="message">職場に対して悩みや要望がございましたら、ご自由にお書きください。</label>
    <textarea name="message" id="message" cols="30" rows="10"></textarea>
  </p>
  <input type="hidden" name="csrf_token" value="<?= h(setToken()); ?>">
  <p>
    <input class="btn-primary"  type="submit"value="入力内容を確認する">
  </p>
  </form>

  <form action="../login/staff_logout.php" method="post">
    <input class="btn-primary" type="submit" name="logout" value="ログアウト">
  </form>
</body>
</html>