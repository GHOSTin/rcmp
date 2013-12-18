<?php namespace app\errors\controllers;

class error404 extends \app\controller{
  
  public function execute(\app\request $request){
    header("HTTP/1.0 404 Not Found");
    die('404');
    exit();
  }
}