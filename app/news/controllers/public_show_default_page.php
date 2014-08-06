<?php namespace app\news\controllers;

use \boxxy\classes\controller;
use \boxxy\classes\di;
use \boxxy\interfaces\request;

class public_show_default_page extends controller{

  public function execute(request $request){
    return ['news'=>di::get('\app\news\mapper')->find_actual_news()];
  }
}