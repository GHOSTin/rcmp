<?php namespace app\podcasts\controllers;

use \boxxy\classes\controller;
use \boxxy\classes\di;
use \boxxy\interfaces\request;

class public_show_default_page extends controller{

  public function execute(request $request){
    $podcasts = di::get('em')->getRepository('\app\podcasts\podcast')->findBy(array(), array('time' => 'DESC'));
    return ['podcasts' => $podcasts];
  }
}