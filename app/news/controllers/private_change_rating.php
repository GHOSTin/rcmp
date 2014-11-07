<?php namespace app\news\controllers;

use boxxy\classes\controller;
use boxxy\classes\di;
use boxxy\interfaces\request;

class private_change_rating extends controller {

  public function execute(request $request)
  {
    $em = di::get('em');
    $news = $em->find('\app\news\news', $request->get_property('news_id'));
    $user = di::get('user');
    if(!$news->get_votes()->contains($user) || $user->isNewsAdmin()){
      $rating = (int) $news->get_rating();
      $news->get_votes()->add($user);
      switch($request->get_property('number')){
        case 'up':
          $news->set_rating(++$rating);
          break;
        case 'down':
          $news->set_rating(--$rating);
          break;
      }
      $em->persist($news);
      $em->flush();
    }
    return ['news' => $news];
  }
}