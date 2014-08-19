<?php namespace app\news\controllers;

use \boxxy\classes\controller;
use \boxxy\classes\di;
use \boxxy\interfaces\request;

class public_show_default_page extends controller{

  public function execute(request $request){
    $q = di::get('em')->find('\app\news\news', 1);
    var_dump($q);
    exit();
    return null;
  }
}