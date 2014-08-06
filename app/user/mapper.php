<?php namespace app\user;

use \PDO;
use \RuntimeException;
use \boxxy\classes\mapper_pdo;
use \boxxy\classes\di;
use \app\user\user;

class mapper extends mapper_pdo{

  private static $find_all = "SELECT id, nickname, email, hash
    FROM users ORDER BY nickname";

  private static $find_by_login = "SELECT id, nickname, email, hash
    FROM users WHERE email = :email";

  private static $find_by_id = "SELECT id, nickname, email, hash
    FROM users WHERE id = :id";

  private static $find_by_session = "SELECT id, nickname, email, hash
    FROM users, sessions WHERE session = :session
    AND users.id = sessions.user_id";

  private static $id = "SELECT MAX(`id`) as `max_id` FROM `users`";

  private static $insert = "INSERT INTO users SET id = :id,
    nickname = :nickname, email = :email, hash = :hash";

  private static $update = 'UPDATE users  SET id = :id,
    nickname = :nickname, email = :email, hash = :hash WHERE id = :id';

  private static $session = "INSERT INTO sessions SET session = :session,
    user_id = :user_id";

  public function create_session(user $user){
    $session = sha1($user->get_id().$user->get_nickname().$user->get_email().time());
    $stmt = $this->pdo->prepare(self::$session);
    $stmt->bindValue(':session', $session, PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $user->get_id(), PDO::PARAM_INT);
    if(!$stmt->execute())
      throw new RuntimeException;
    return $session;
  }

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

  public function find_by_id($id){
    $stmt = $this->pdo->prepare(self::$find_by_id);
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
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

  public function find_by_session($session){
    $stmt = $this->pdo->prepare(self::$find_by_session);
    $stmt->bindValue(':session', $session, PDO::PARAM_STR);
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

  public function update(user $user){
    $stmt = $this->pdo->prepare(self::$update);
    $stmt->bindValue(':id', $user->get_id(), PDO::PARAM_INT);
    $stmt->bindValue(':nickname', $user->get_nickname(), PDO::PARAM_STR);
    $stmt->bindValue(':email', $user->get_email(), PDO::PARAM_STR);
    $stmt->bindValue(':hash', $user->get_hash(), PDO::PARAM_STR);
    if(!$stmt->execute())
      throw new RuntimeException();
  }
}