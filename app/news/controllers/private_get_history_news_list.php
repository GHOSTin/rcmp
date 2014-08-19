<?php namespace app\news\controllers;

use boxxy\classes\controller;
use boxxy\classes\di;
use boxxy\interfaces\request;

class private_get_history_news_list extends controller {

  public function execute(request $request)
  {
    return ['news'=>di::get('em')->getRepository('\app\news\news')->find_history_news()];
  }
}