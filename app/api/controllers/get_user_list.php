<?php

namespace app\api\controllers;


use boxxy\classes\controller;
use \app\conf;
use boxxy\classes\di;

class get_user_list extends controller {

  public function execute(\boxxy\interfaces\request $request)
  {
    if ($request->get_property('key') == conf::API_KEY){
      $users = di::get('em')->getRepository('\app\user\user')->findAll();
      return ['users' => $users];
    }
    return null;
  }
}