<?php namespace app\user;

use \PDO;
use \RuntimeException;
use \boxxy\classes\mapper_pdo;
use \boxxy\di;
use \app\user\user;

class mapper extends mapper_pdo{

  private static $find_all = "SELECT id, nickname, email, hash
    FROM users ORDER BY nickname";

  private static $find_by_login = "SELECT id, nickname, email, hash
    FROM users WHERE email = :email";

  private static $id = "SELECT MAX(`id`) as `max_id` FROM `users`";
  private static $insert = "INSERT INTO users SET id = :id,
    nickname = :nickname, email = :email, hash = :hash";

  public function find_all(){
    $stmt = $this->pdo->prepare(self::$find_all);
    if(!$stmt->execute())
      throw new RuntimeException;
    $users = [];
    while($row = $stmt->fetch())
      $users[] = di::get('\app\user\factory')->build($row);
    return $users;
  }

  public function find_by_email($email){
    $stmt = $this->pdo->prepare(self::$find_by_login);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    if(!$stmt->execute())
      throw new RuntimeException;
    $count = $stmt->rowCount();
    if($count === 0)
      return null;
    elseif($count === 1)
      return di::get('\app\user\factory')->build($stmt->fetch());
    else
      throw new RuntimeException;
  }

  public function get_insert_id(){
    $stmt = $this->pdo->prepare(self::$id);
    if(!$stmt->execute())
      throw new RuntimeException;
    return $stmt->fetch()['max_id'] + 1;
  }

  public function insert(user $user){
    $stmt = $this->pdo->prepare(self::$insert);
    $stmt->bindValue(':id', $user->get_id(), PDO::PARAM_INT);
    $stmt->bindValue(':email', $user->get_email(), PDO::PARAM_STR);
    $stmt->bindValue(':nickname', $user->get_nickname(), PDO::PARAM_STR);
    $stmt->bindValue(':hash', $user->get_hash(), PDO::PARAM_STR);
    if(!$stmt->execute())
      throw new RuntimeException;
  }
}