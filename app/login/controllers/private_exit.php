<?php namespace app\login\controllers;

use \boxxy\di;

class private_exit extends \app\controller{

  public function execute(\app\request $request){
    $php = di::get('\app\php');
    $php->session_destroy();
    $php->header('Location: /');
  }
}