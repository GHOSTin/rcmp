<?php
namespace app\news\controllers;

use boxxy\classes\controller;
use boxxy\classes\di;
use boxxy\interfaces\request;

class private_attach_news extends controller {

  public function execute(request $request)
  {
    $em = di::get('em');
    $podcast = $em->find('\app\podcasts\podcast', $request->get_property('podcast'));
    foreach ($request->get_property('news') as $id) {
      $news = $em->find('\app\news\news', $id);
      $news->set_podcast($podcast);
    }
    $em->flush();
    return ['attach_ids'=> $request->get_property('news')];
  }
}