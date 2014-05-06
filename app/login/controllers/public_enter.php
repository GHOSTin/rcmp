<?php namespace app\login\controllers;

use \app\user\mapper;
use \app\env;
use \app\conf;
use \app\session;

class public_enter extends \app\controller{

  public function execute(\app\request $request){
    $user = (new mapper(env::get_pdo()))->find_by_email($request->POST('login'));
    if(!is_null($user)){
      if($user->get_hash() === sha1(md5($request->POST('password').conf::auth_salt))){
        $_SESSION['user'] = $user;
        header('Location: /');
        return true;
      }
    }else
      return false;
  }
}