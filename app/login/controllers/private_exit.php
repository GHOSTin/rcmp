<?php namespace app\login\controllers;

class private_exit extends \app\controller{
  
  public function execute(\app\request $request){
    session_destroy();
    header('Location: /');
    exit();
  }
}