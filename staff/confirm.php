<?php
session_start();
require_once __DIR__ . '/../classes/UserLogic.php';
require_once __DIR__ . '/../functions.php';


$token = filter_input(INPUT_POST, 'csrf_token');
if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
exit('不正なリクエストです');
}

$err = [];

  // 名前のバリデーション
  if(!$name = filter_input(INPUT_POST, 'name')) {
    $err['name'] = '名前を入力してください';
  }

// メールドレスのバリデーション
if(!$email = filter_input(INPUT_POST, 'email')) {
  $err['email'] = 'メールアドレスを入力してください';
}

// 満足度のバリデーション
if(!$satisfaction = filter_input(INPUT_POST, 'satisfaction')) {
  $err['satisfaction'] = '選択してください';
}

// メッセージのバリデーション
if(!$message = filter_input(INPUT_POST, 'message')) {
  $err['message'] = '入力してください';
}

if (count($err) > 0) {
  $_SESSION['err'] = $err;
  header('Location: ./index.php');
  exit();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/style.css">
  <title>アンケート 確認画面</title>
</head>
<body>
  <h2 class="page-title">アンケート 確認画面</h2>
  <p class="q">名前</p>
  <p class="a"><?= h($_POST['name']); ?></p>
  <p class="q">メールアドレス</p>
  <p class="a"><?= h($_POST['email']); ?></p>
  <p class="q">評価</p>
  <p class="a"><?php
  if ($_POST['satisfaction'] === 'good') {
    echo h('満足');
  }
  if ($_POST['satisfaction'] === 'medium') {
    echo h('普通');
  }
  if ($_POST['satisfaction'] === 'bad') {
    echo h('不満');
  }
  ?></p>
  <p class="q">メッセージ</p>
  <p class="a"><?= h($_POST['message']); ?></p>
  <form action="qa-complete.php" method="post">
  <p>
    <input class="btn-primary"  type="submit" value="アンケートを送信する">
  </p>
    <input type="hidden" name="name" value="<?= h($_POST['name']); ?>">
    <input type="hidden" name="email" value="<?= h($_POST['email']); ?>">
    <input type="hidden" name="satisfaction" value="<?= h($_POST['satisfaction']); ?>">
    <input type="hidden" name="message" value="<?= h($_POST['message']); ?>">
  </form>
</body>
</html>