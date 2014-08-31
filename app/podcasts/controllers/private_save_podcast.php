<?php
namespace app\podcasts\controllers;

use app\podcasts\podcast;
use boxxy\classes\controller;
use boxxy\classes\di;
use boxxy\interfaces\request;

class private_save_podcast extends controller{

  public function execute(request $request)
  {
    $em = di::get('em');
    $podcast = new podcast();
    $podcast->set_time(time());
    $podcast->set_name($request->get_property('title'));
    $podcast->set_alias($request->get_property('alias'));
    $podcast->set_url($request->get_property('url'));
    $em->persist($podcast);
    $em->flush();
    return ['podcast' => $podcast];
  }
}