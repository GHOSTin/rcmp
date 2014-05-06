<?php namespace app\default_page\controllers;

use \boxxy\classes\controller;
use \boxxy\interfaces\request;

class private_show_default_page extends controller{

  public function execute(request $request){
    return true;
  }
}