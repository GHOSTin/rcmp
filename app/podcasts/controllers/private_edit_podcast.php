<?php
namespace app\podcasts\controllers;

use app\podcasts\podcast;
use boxxy\classes\controller;
use boxxy\classes\di;
use boxxy\interfaces\request;
use DateTime;

class private_edit_podcast extends controller{

  public function execute(request $request)
  {
    $em = di::get('em');
    $podcast = $em->find('\app\podcasts\podcast', $request->get_property('id'));
    if(di::get('user')->isPodcastAdmin()){
      $dtime = DateTime::createFromFormat("d.m.Y H:i:s", $request->get_property('time').' 00:00:00');
      $timestamp = $dtime->getTimestamp();
      if($podcast->get_time() != $timestamp) {
        $show = $podcast->get_showPodcast();
        $podcast_news = $podcast->get_news();
        $em->remove($podcast);
        $podcast = new podcast();
        $podcast->set_showPodcast($show);
        $podcast->set_news($podcast_news);
        foreach ($podcast_news as $news) {
          $news->set_podcast($podcast);
        }
      }
      $podcast->set_time($timestamp);
      $podcast->set_name($request->get_property('title'));
      $podcast->set_alias($request->get_property('alias'));
      $podcast->set_url($request->get_property('url'));
      $em->persist($podcast);
      $em->flush();
    }
    return ['podcast' => $podcast];
  }
}