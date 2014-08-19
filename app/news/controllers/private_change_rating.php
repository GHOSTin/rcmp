<?php namespace app\news\controllers;

use boxxy\classes\controller;
use boxxy\classes\di;
use boxxy\interfaces\request;

class private_change_rating extends controller {

  public function execute(request $request)
  {
    /** @var $em \Doctrine\ORM\EntityManager */
    $em = di::get('em');
    $news = $em->find('\app\news\news',$request->get_property('news_id'));
    if(!$news->get_votes()->contains($em->find('\app\user\user', 1))){
      $rating = (int)$news->get_rating();
      $news->get_votes()->add($em->find('\app\user\user', 1));
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
      $em->persist($news);
      $em->flush();
    }
    return ['news' => $news];
  }
}