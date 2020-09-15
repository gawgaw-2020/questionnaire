<?php

require_once 'classes/UserLogic.php';

$stmt = UserLogic::getAllUsers();



?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>スタッフ一覧</title>
</head>
<body>
  <h2>スタッフ一覧</h2>
  <ul>
    <?php foreach ($stmt as $row): ?>
    <li>
      <p>スタッフID：<?= $row['id'] ?></p>
      <p>名前：<?= $row['name'] ?></p>
      <p>メールアドレス：<?= $row['email'] ?></p>
      <p>
        質問への回答：
        <?php if($row['answer'] === 0): ?>
          未回答
        <?php else: ?>
          回答済み
        <?php endif; ?>
      </p>
    </li>
    <?php endforeach; ?>
  </ul>
</body>
</html>