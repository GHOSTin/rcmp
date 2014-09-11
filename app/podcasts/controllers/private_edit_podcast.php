<?php
namespace app\podcasts\controllers;

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
      $podcast->set_time($timestamp);
      $podcast->set_name($request->get_property('title'));
      $podcast->set_alias($request->get_property('alias'));
      $podcast->set_url($request->get_property('url'));
      $em->flush();
    }
    return ['podcast' => $podcast];
  }
}