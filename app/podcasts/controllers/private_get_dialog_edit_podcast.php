<?php
namespace app\podcasts\controllers;

use boxxy\classes\controller;
use boxxy\classes\di;
use boxxy\interfaces\request;

class private_get_dialog_edit_podcast extends controller{

  public function execute(request $request)
  {
    return ['podcast' => di::get('em')->find('\app\podcasts\podcast', $request->get_property('podcast_id'))];
  }
}