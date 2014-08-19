<?php namespace app\news\controllers;

use boxxy\classes\controller;
use boxxy\classes\di;
use boxxy\interfaces\request;

class private_get_dialog_edit_news extends controller{

  public function execute(request $request)
  {
    return ['news'=> di::get('em')->find('\app\news\news', $request->get_property('news_id'))];
  }
}