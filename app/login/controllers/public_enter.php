<?php namespace app\login\controllers;

use \boxxy\di;
use \app\conf;
use \boxxy\classes\controller;
use \boxxy\interfaces\request;

class public_enter extends controller{

  public function execute(request $request){
    $mapper = di::get('\app\user\mapper');
    $user = $mapper->find_by_email($request->get_property('login'));
    $php = di::get('\app\php');
    if(!is_null($user)){
      if($user->get_hash() === sha1(md5($request->get_property('password').conf::auth_salt))){
        setcookie('uid', $mapper->create_session($user), strtotime('+30 days'), '/');
        $php->header('Location: /');
        return true;
      }
    }else
      return false;
  }
}