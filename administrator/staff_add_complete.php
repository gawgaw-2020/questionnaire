<?php
session_start();

require_once __DIR__ . '/../classes/UserLogic.php';
require_once __DIR__ . '/../functions.php';
$err = [];

$token = filter_input(INPUT_POST, 'csrf_token');
if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
  exit('不正なリクエストです');
}

unset($_SESSION['csrf_token']);

  // 名前のバリデーション
  if(!$name = filter_input(INPUT_POST, 'name')) {
    $err[] = '名前を入力してください';
  }

  // メールドレスのバリデーション
  if(!$email = filter_input(INPUT_POST, 'email')) {
    $err[] = 'メールアドレスを入力してください';
  }
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $err[] = 'メールアドレスは正しい形式で入力してください';
    }
  $alreadyRecorded = UserLogic::searchUserEmail($_POST);
  if ($alreadyRecorded) {
    $err[] = 'メールアドレスが既に登録されています';
  }

  // パスワードのバリデーション
  $password = filter_input(INPUT_POST, 'password');
  if (!preg_match("/\A[a-z\d]{4,100}+\z/i", $password)) {
    $err[] = 'パスワードは英数字4文字以上で入力してください';
  }
  $password_conf = filter_input(INPUT_POST, 'password_conf');
  if ($password !== $password_conf) {
    $err[] = '確認用パスワードと異なっています';
  }

  if (count($err) === 0) {
    $hasCreated = UserLogic::createUser($_POST);
    if (!$hasCreated) {
      $err = '登録に失敗しました';
    }
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/style.css">
  <title>スタッフ新規登録 結果画面</title>
</head>
<body>
  <h2 class="page-title">スタッフ新規登録 結果画面</h2>
  <?php if(count($err) > 0): ?>
    <?php foreach ($err as $e): ?>
      <p class="err"><?= h($e); ?></p>
    <?php endforeach; ?>
    <a class="btn-primary" href="#" onclick="window.history.back(); return false;">直前のページに戻る</a>
  <?php else: ?>
  <p class="result">スタッフ登録が完了しました。</p>
  <?php endif; ?>
  <a class="btn-primary" href="./index.php">一覧画面へ戻る</a>
</body>
</html>