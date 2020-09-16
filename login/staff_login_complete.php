<?php
session_start();

require_once __DIR__ . '/../classes/UserLogic.php';

$token = filter_input(INPUT_POST, 'csrf_token');

if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
exit('不正なリクエストです');
}

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
    if (isset($_POST['email'])) {
      $err['input_email'] = $_POST['email'];
    }
    $_SESSION = $err;
    header('Location: ./staff_login.php');
    exit();
  }

  $result = UserLogic::login($email, $password);

  if(!$result) {
    header('Location: ./staff_login.php');
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
  <title>スタッフログイン 完了画面</title>
</head>
<body>
  <h2 class="page-title">スタッフログイン 完了画面</h2>
  <p class="result">ログインが完了しました。</p>
  <a class="btn-primary" href="../staff/index.php">アンケート画面へ</a>
</body>
</html>