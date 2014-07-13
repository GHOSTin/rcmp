<?php namespace app\user;

use \app\conf;
use \boxxy\classes\di;

class model{

  public function recovery_password(user $user){
    $pdo = di::get('pdo');
    $pdo->beginTransaction();
    $password = substr(str_shuffle(sha1(time())), 0, 8);
    $user->set_hash(sha1(md5($password.conf::auth_salt)));
    di::get('\app\user\mapper')->update($user);
    $php = di::get('\app\php');
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/plain; charset=utf-8";
    $headers[] = 'From: nekrasov@mlsco.ru';
    $headers[] = 'X-Mailer: PHP/' . phpversion();
    $message = 'Ваш новый пароль: '.$password;
    $php->mail($user->get_email(), 'Recovery password', $message, implode("\r\n", $headers));
    $pdo->commit();
    return ['user' => $user, 'password' => $password];
  }

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