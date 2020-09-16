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
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/style.css">
  <title>スタッフ一覧</title>
</head>
<body>
  <h2 class="page-title">スタッフ一覧</h2>
  <a class="btn-primary" href="./staff_add.php">スタッフ新規追加</a>
  <div class="staff-list">
    <ul>
      <li class="staff-list__item">
        <p class="id-box">ID</p>
        <p class="name-box">名前</p>
        <p class="email-box">メールアドレス</p>
        <p class="q-box">質問への回答</p>
      </li>
      <?php foreach ($users as $row): ?>
      <li class="staff-list__item">
        <p class="id-box"><?= h($row['id']) ?></p>
        <p class="name-box"><?= h($row['name']) ?></p>
        <p class="email-box"><?= h($row['email']) ?></p>
        <p class="q-box">
          <?php if($row['answer'] === 0): ?>
            未回答
          <?php else: ?>
            回答済み
          <?php endif; ?>
        </p>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</body>
</html>