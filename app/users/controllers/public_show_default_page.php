<?php namespace app\users\controllers;

use \boxxy\di;

class public_show_default_page extends \app\controller{

  public function execute(\app\request $request){
    return ['users' => di::get('\app\user\mapper')->find_all()];
  }
}