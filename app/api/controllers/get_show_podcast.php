<?php namespace app\api\controllers;

use \boxxy\classes\di;
use \boxxy\classes\controller;
use \boxxy\interfaces\request;

class get_show_podcast extends controller{

  public function execute(request $request){
    $podcast = di::get('em')->getRepository('\app\podcasts\podcast')->findOneByShowPodcast('1');
    if(!$podcast)
      return null;
    return ['podcast' => $podcast];
  }
}