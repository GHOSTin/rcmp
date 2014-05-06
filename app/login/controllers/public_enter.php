<?php namespace app\login\controllers;

use \boxxy\di;
use \app\conf;

class public_enter extends \app\controller{

  public function execute(\app\request $request){
    $user = di::get('\app\user\mapper')
      ->find_by_email($request->get_property('login'));
    $php = di::get('\app\php');
    if(!is_null($user)){
      if($user->get_hash() === sha1(md5($request->get_property('password').conf::auth_salt))){
        $php->set_session_value('user', $user);
        $php->header('Location: /');
        return true;
      }
    }else
      return false;
  }
}