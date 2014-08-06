<?php namespace app\news\controllers;

use boxxy\classes\controller;
use boxxy\classes\di;
use boxxy\interfaces\request;

class private_save_news extends controller {

  public function execute(request $request)
  {
    $news = di::get('\app\news\model')->add_news($request->get_property('title'), $request->get_property('description'));
    return ['news'=> $news];
  }
}