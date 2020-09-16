<?php

require_once __DIR__ . '/../dbconnect.php';

class UserLogic {


    /**
   * メールアドレスが既に登録されていたら1を返す
   * @param array $userData
   * @return int $cnt
   */
  public static function searchUserEmail($userData){

    $cnt = 0;

    $sql = 'SELECT COUNT(*) as cnt FROM users WHERE email=?';

    $arr = [];
    $arr[] = $userData['email'];

    try {
      $stmt = connect()->prepare($sql);
      $stmt->execute($arr);
      $record = $stmt->fetch();
      $cnt = $record['cnt'];
      return $cnt;
    } catch(\Exception $e) {
      return $cnt;
    }
  }


  /**
   * 全てのユーザー情報を取得する
   * @return object(PDOStatement) $users
   */
  public static function getAllUsers() {
    $sql = 'SELECT * FROM users';

    try {
      $users = connect()->query($sql);
      return $users;
    } catch(\Exception $e) {
      return $users;
    }
  }


  /**
   * ユーザーを登録する
   * @param array $userData
   * @return bool $result
   */
  public static function createUser($userData){

    $result = false;

    $sql = 'INSERT INTO users (name, email, password) VALUE(?, ?, ?)';

    $arr = [];
    $arr[] = $userData['name'];
    $arr[] = $userData['email'];
    $arr[] = password_hash($userData['password'], PASSWORD_DEFAULT);

    try {
      $stmt = connect()->prepare($sql);
      $result = $stmt->execute($arr);
      return $result;
    } catch(\Exception $e) {
      return $result;
    }
  }

  /**
   * スタッフログイン処理
   * @param string $email
   * @param string $password
   * @return bool $result
   */
  public static function login($email, $password) {
    $result = false;

    $user = self::getUserByEmail($email);

    if (!$user) {
      $_SESSION['msg'] = 'メールアドレスが一致しません';
      return $result;
    }

    if(password_verify($password, $user['password'])) {
      session_regenerate_id(true);
      $_SESSION['login_user'] = $user;
      $result = true;
      return $result;
    }
    $_SESSION['msg'] = 'パスワードが一致しません';
    return $result;

  }

  /**
   * emailからユーザーを取得
   * @param string $email
   * @return array|bool $user|false
   */
  public static function getUserByEmail($email) {
    $sql = 'SELECT * FROM users WHERE email=?';

    $arr = [];
    $arr[] = $email;

    try {
      $stmt = connect()->prepare($sql);
      $stmt->execute($arr);
      $user = $stmt->fetch();
      return $user;
    } catch(\Exception $e) {
      return $user;
    }

  }


    /**
   * ログインチェック
   * @return bool $result
   */
  public static function checkLogin() {
    $result = false;

    if (isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0) {
      return $result = true;
    }

    return $result;

  }


      /**
   * ログアウト処理
   */
  public static function logout() {
    $_SESSION = array();
    session_destroy();
  }


    /**
   * emailからanswerカラムを更新
   * @param string $email
   * @return bool $result
   */
  public static function updateAnswer($email) {
    $sql = 'UPDATE users SET answer = 1 WHERE email=?';

    $arr = [];
    $arr[] = $email;

    try {
      $stmt = connect()->prepare($sql);
      $result = $stmt->execute($arr);
      return $result;
    } catch(\Exception $e) {
      return $result;
    }

  }

}


?>