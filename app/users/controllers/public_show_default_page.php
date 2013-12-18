<?php namespace app\users\controllers;

use \app\user\mapper;
use \app\env;

class public_show_default_page extends \app\controller{

  public function execute(\app\request $request){
    return ['users' => (new mapper(env::get_pdo()))->find_all()];
  }
}