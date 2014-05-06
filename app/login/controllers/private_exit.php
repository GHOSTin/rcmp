<?php namespace app\login\controllers;

use \boxxy\di;
use \boxxy\classes\controller;
use \boxxy\interfaces\request;

class private_exit extends controller{

  public function execute(request $request){
    $php = di::get('\app\php');
    $php->session_destroy();
    $php->header('Location: /');
  }
}