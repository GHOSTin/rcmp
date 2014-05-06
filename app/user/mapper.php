<?php namespace app\user;

use \PDO;
use \RuntimeException;
use \boxxy\classes\mapper_pdo;

class mapper extends mapper_pdo{

  private static $find_all = "SELECT id, nickname, email, hash
    FROM users ORDER BY nickname";

  private static $find_by_login = "SELECT id, nickname, email, hash
    FROM users WHERE email = :email";

  public function create_object(array $row){
    $user = new user();
    $user->set_id($row['id']);
    $user->set_nickname($row['nickname']);
    $user->set_email($row['email']);
    $user->set_hash($row['hash']);
    return $user;
  }

  public function find_all(){
    $stmt = $this->pdo->prepare(self::$find_all);
    if(!$stmt->execute())
      throw new RuntimeException;
    $users = [];
    while($row = $stmt->fetch())
      $users[] = $this->create_object($row);
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
      return $this->create_object($stmt->fetch());
    else
      throw new RuntimeException;
  }
}