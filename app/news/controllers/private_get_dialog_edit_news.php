<?php namespace app\news\controllers;

use boxxy\classes\controller;
use boxxy\classes\di;
use boxxy\interfaces\request;

class private_get_dialog_edit_news extends controller{

  public function execute(request $request)
  {
    return ['news'=> di::get('\app\news\mapper')->find_by_id($request->get_property('news_id'))];
  }
}