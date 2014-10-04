<?php

namespace app\podcasts\controllers;


use boxxy\classes\controller;
use boxxy\classes\di;

class private_change_showing_podcast extends controller{

  public function execute(\boxxy\interfaces\request $request)
  {
    $em = di::get('em');
    $podcast = $em->find('\app\podcasts\podcast', $request->get_property('id'));
    if ($podcast) {
      $oldPodcast = $em->getRepository('\app\podcasts\podcast')->findOneByshowPodcast("1");
      if($oldPodcast)
        $oldPodcast->set_showPodcast("0");
      $podcast->set_showPodcast("1");
      $em->flush();
    }
    return ['podcasts'=> $em->getRepository('\app\podcasts\podcast')->findBy(array(), array('time' => 'DESC'))];
  }
}