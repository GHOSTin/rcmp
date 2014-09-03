<?php namespace app\news\controllers;

use \boxxy\classes\controller;
use \boxxy\classes\di;
use \boxxy\interfaces\request;

class private_show_default_page extends controller{

  public function execute(request $request){
    if(di::get('user')->isNewsAdmin())
      return ['podcasts' => di::get('em')->getRepository('\app\podcasts\podcast')->findAll(),
          'news'=>di::get('em')->getRepository('\app\news\news')->findByPodcast(null)];
    return ['news'=>di::get('em')->getRepository('\app\news\news')->findByPodcast(null)];
  }
}