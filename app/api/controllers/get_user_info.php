<?php namespace app\api\controllers;

use \boxxy\classes\di;
use \boxxy\classes\controller;
use \boxxy\interfaces\request;

class get_user_info extends controller{

  public function execute(request $request){
    $session = di::get('em')->getRepository('\app\session\session')->find($request->get_property('key'));
    return ['user' => $session->get_user()];
  }
}