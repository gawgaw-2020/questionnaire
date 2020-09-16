<?php

require_once __DIR__ . '/../classes/UserLogic.php';
require_once __DIR__ . '/../functions.php';

$users = UserLogic::getAllUsers();


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
  <a href="./staff_add.php">スタッフ新規追加</a>
  <ul>
    <?php foreach ($users as $row): ?>
    <li>
      <p>スタッフID：<?= h($row['id']) ?></p>
      <p>名前：<?= h($row['name']) ?></p>
      <p>メールアドレス：<?= h($row['email']) ?></p>
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