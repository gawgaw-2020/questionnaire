<?php

  require_once __DIR__ . '/../classes/UserLogic.php';

  session_start();

  $err = [];

  // メールドレスのバリデーション
  if(!$email = filter_input(INPUT_POST, 'email')) {
    $err['email'] = 'メールアドレスを入力してください';
  }
  
  // パスワードのバリデーション
  if(!$password = filter_input(INPUT_POST, 'password')) {
    $err['password'] = 'パスワードを入力してください';
  }

  if (count($err) > 0) {
    $_SESSION = $err;
    header('Location: ./staff_login.php');
    exit();
  }

  $result = UserLogic::login($email, $password);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>スタッフ新規登録 結果画面</title>
</head>
<body>
  <h2>スタッフ新規登録 結果画面</h2>
  <?php if(count($err) > 0): ?>
    <?php foreach ($err as $e): ?>
      <p><?= $e; ?></p>
    <?php endforeach; ?>
    <a href="#" onclick="window.history.back(); return false;">直前のページに戻る</a>
  <?php else: ?>
  <p>スタッフ登録が完了しました。</p>
  <?php endif; ?>
  <a href="/index.php">一覧画面へ戻る</a>
</body>
</html>