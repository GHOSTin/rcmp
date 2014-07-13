<?php namespace app\registration\controllers;

use \boxxy\classes\di;
use \boxxy\classes\controller;
use \boxxy\interfaces\request;

class public_do extends controller{

  public function execute(request $request){
    $nickname = trim($request->get_property('nickname'));
    $email = trim($request->get_property('email'));
    $password = trim($request->get_property('password'));
    $user = di::get('\app\user\model')->register($nickname, $email, $password);
    if(!is_null($user)){
      $php = di::get('\app\php');
      $php->set_session_value('user', $user);
      $php->header('Location: /');
    }
    return null;
  }
}