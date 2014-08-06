<?php namespace app\news\controllers;

use boxxy\classes\controller;
use boxxy\classes\di;
use boxxy\interfaces\request;

class private_change_rating extends controller {

  public function execute(request $request)
  {
    /** @var \app\news\news $news */
    /** @var \app\news\mapper $mapper */
    $mapper = di::get('\app\news\mapper');
    di::get('\app\news2votes\mapper')->insert($request->get_property('news_id'));
    $news = $mapper->find_by_id($request->get_property('news_id'));
    $rating = (int)$news->get_rating();
    switch($request->get_property('number')){
      case 'up':
        $news->set_rating($rating+1);
        break;
      case 'down':
        $news->set_rating($rating-1);
        break;
      default:
        $news->set_rating($rating);
        break;
    }
    $mapper->update($news);
    return ['news' => $news];
  }
}