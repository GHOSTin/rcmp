<?php namespace app\users\controllers;

use \boxxy\classes\di;
use \boxxy\classes\controller;
use \boxxy\interfaces\request;

class public_show_default_page extends controller{

  public function execute(request $request){
    return ['users' => di::get('\app\user\mapper')->find_all()];
  }
}