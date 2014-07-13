<?php namespace app\api\controllers;

use \boxxy\classes\di;
use \boxxy\classes\controller;
use \boxxy\interfaces\request;

class get_user_info extends controller{

  public function execute(request $request){
    return ['user' => di::get('\app\user\mapper')
      ->find_by_session($request->get_property('key'))];
  }
}