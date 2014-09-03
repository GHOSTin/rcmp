<?php
namespace app\podcasts\controllers;

use boxxy\classes\controller;
use boxxy\classes\di;
use boxxy\interfaces\request;

class private_delete_podcast extends controller{

  public function execute(request $request)
  {
    $em = di::get('em');
    $id = null;
    $podcast = $em->find('\app\podcasts\podcast', $request->get_property('podcast_id'));
    if(di::get('user')->isPodcastAdmin()){
      foreach ($podcast->get_news() as $news) {
        $podcast->get_news()->removeElement($news);
        $news->set_podcast(null);
      }
      $id = $podcast->get_time();
      $em->remove($podcast);
      $em->flush();
    }
    return ['delete_id' => $id];
  }
}