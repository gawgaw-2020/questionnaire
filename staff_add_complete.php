<?php

  require_once 'classes/UserLogic.php';
  $err = [];

  $isCreated = UserLogic::searchUserEmail($_POST);

  if(!$name = filter_input(INPUT_POST, 'name')) {
    $err[] = '名前を入力してください';
  }
  if(!$email = filter_input(INPUT_POST, 'email')) {
    $err[] = 'メールアドレスを入力してください';
  }
  $password = filter_input(INPUT_POST, 'password');
  if (!preg_match("/\A[a-z\d]{4,100}+\z/i", $password)) {
    $err[] = 'パスワードは英数字4文字以上で入力してください';
  }
  if ($isCreated) {
    $err[] = 'メールアドレスが既に登録されています';
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
  <title>スタッフ新規登録 完了画面</title>
</head>
<body>
  <h2>スタッフ新規登録 完了画面</h2>
  <?php if(count($err) > 0): ?>
    <?php foreach ($err as $e): ?>
      <p><?= $e; ?></p>
    <?php endforeach; ?>
  <?php else: ?>
  <p>スタッフ登録が完了しました。</p>
  <?php endif; ?>
  <a href="./index.php">一覧画面へ戻る</a>
</body>
</html>