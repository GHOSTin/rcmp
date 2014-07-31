<?php namespace app\donation\controllers;

use \boxxy\classes\controller;
use \boxxy\interfaces\request;

class public_show_default_page extends controller{

  public function execute(request $request){
    return true;
  }
}