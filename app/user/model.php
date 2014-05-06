<?php namespace app\user;

use \app\conf;
use \boxxy\di;

class model{

  public function register($nickname, $email, $password){
    $pdo = di::get('pdo');
    $mapper = di::get('\app\user\mapper');
    $pdo->beginTransaction();
    if(!is_null($mapper->find_by_email($email))){
      $pdo->rollBack();
      return null;
    }
    $row = ['nickname' => $nickname, 'email' => $email,
      'hash' => sha1(md5($password.conf::auth_salt)),
      'id' => $mapper->get_insert_id()];
    $user = di::get('\app\user\factory')->build($row);
    $mapper->insert($user);
    $pdo->commit();
    return $user;
  }
}