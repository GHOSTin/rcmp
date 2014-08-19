<?php namespace app\password\controllers;

use \boxxy\classes\di;
use \boxxy\interfaces\request;
use \boxxy\classes\controller;

class public_recovery extends controller{

  public function execute(request $request){
    $user = di::get('em')->getRepository('\app\user\user')->findOneBy(array('email'=>$request->get_property('login')));
    if(is_null($user))
      return ['error' => 'no_user'];
    return di::get('\app\user\model')->recovery_password($user);
  }
}