<?php namespace app\podcasts\controllers;

use \boxxy\classes\controller;
use \boxxy\classes\di;
use \boxxy\interfaces\request;

class private_show_default_page extends controller{

  public function execute(request $request){
    return ['podcasts' => di::get('em')->getRepository('\app\podcasts\podcast')->findAll()];
  }
}