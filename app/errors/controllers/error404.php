<?php namespace app\errors\controllers;

use \boxxy\classes\controller;
use \boxxy\interfaces\request;

class error404 extends controller{

  public function execute(request $request){
    $uri = explode('\\', __CLASS__);
    $request->set_uri('/'.$uri[1].'/'.$uri[3].'/');
  }
}