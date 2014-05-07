<?php namespace app\login\controllers;

use \boxxy\di;
use \boxxy\classes\controller;
use \boxxy\interfaces\request;

class private_exit extends controller{

  public function execute(request $request){
    $php = di::get('\app\php');
    setcookie("uid", "", time() - 3600, '/');
    $php->header('Location: /');
  }
}