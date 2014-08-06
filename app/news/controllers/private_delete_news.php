<?php namespace app\news\controllers;

use boxxy\classes\controller;
use boxxy\classes\di;
use boxxy\interfaces\request;

class private_delete_news extends controller {

  public function execute(request $request)
  {
    $id = di::get('\app\news\model')->delete_news($request->get_property('news_id'));
    return ['delete_id'=> $id];
  }
}