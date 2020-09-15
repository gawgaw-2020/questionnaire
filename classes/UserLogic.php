<?php

require_once 'dbconnect.php';

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
   * @return object(PDOStatement) $stmt
   */
  public static function getAllUsers() {
    $sql = 'SELECT * FROM users';

    try {
      $stmt = connect()->query($sql);
      return $stmt;
    } catch(\Exception $e) {
      return $stmt;
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
}


?>