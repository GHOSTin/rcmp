<?php namespace app\user;

use \app\conf;
use \boxxy\classes\di;

class model{

  public function recovery_password(user $user){
    $em = di::get('em');
    $password = substr(str_shuffle(sha1(time())), 0, 8);
    $user->set_hash(sha1(md5($password.conf::auth_salt)));
    $em->persist($user);
    $em->flush();
    $php = di::get('\app\php');
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/plain; charset=utf-8";
    $headers[] = 'From: nekrasov@mlsco.ru';
    $headers[] = 'X-Mailer: PHP/' . phpversion();
    $message = 'Ваш новый пароль: '.$password;
    $php->mail($user->get_email(), 'Recovery password', $message, implode("\r\n", $headers));
    return ['user' => $user, 'password' => $password];
  }

  public function register($nickname, $email, $password){
    $em = di::get('em');
    if(!is_null($em->getRepository('\app\user\user')->findOneBy(array('email'=>$email)))){
      return null;
    }
    $user = new \app\user\user();
    $user->set_email($email);
    $user->set_nickname($nickname);
    $user->set_hash(sha1(md5($password.conf::auth_salt)));
    $em->persist($user);
    $em->flush();
    return $user;
  }
}