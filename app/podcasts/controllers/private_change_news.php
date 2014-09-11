<?php
namespace app\podcasts\controllers;

use boxxy\classes\controller;
use boxxy\classes\di;
use boxxy\interfaces\request;

/**
 * Class change_news
 * @package app\podcasts\controllers
 */
class private_change_news extends controller {

  /**
   * @param \boxxy\interfaces\request $request
   * @return array
   */
  public function execute(request $request)
  {
    /**
     * @var \app\podcasts\podcast $podcast
     * @var \app\news\news $news
     * @var \Doctrine\ORM\EntityManager $em
     */
    $em = di::get('em');
    $podcast = $em->find('\app\podcasts\podcast', $request->get_property('id'));
    if(di::get('user')->isPodcastAdmin()){
      $news = $em->find('\app\news\news', $request->get_property('news_id'));
      $podcast->get_news()->removeElement($news);
      $news->set_podcast(null);
      $em->flush();
    }
    return ['podcast' => $podcast];
  }
}