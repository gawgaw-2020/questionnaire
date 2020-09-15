<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>スタッフ登録</title>
</head>
<body>
  <h2>スタッフ新規登録</h2>
  <form action="staff_add_check.php" method="post">
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
  <p>
    <input type="submit" value="登録する">
  </p>
  </form>
</body>
</html>