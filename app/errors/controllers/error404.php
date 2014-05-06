<?php namespace app\errors\controllers;

use \boxxy\classes\controller;
use \boxxy\interfaces\request;

class error404 extends controller{

  public function execute(request $request){
    header("HTTP/1.0 404 Not Found");
    die('404');
    exit();
  }
}