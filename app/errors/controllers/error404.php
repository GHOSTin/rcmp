<?php namespace app\errors\controllers;

use \boxxy\di;
use \boxxy\classes\controller;
use \boxxy\interfaces\request;

class error404 extends controller{

  public function execute(request $request){
    $php = di::get('\app\php');
    $php->header("HTTP/1.0 404 Not Found");
  }
}