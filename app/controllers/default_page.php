<?php namespace app\controllers;

use Silex\Application;

class default_page{

  public function default_page(Application $app){
    $podcast = $app['em']->getRepository('\app\domain\podcast')
                         ->findOneByShowPodcast('1');
    return $app['twig']->render('default_page.tpl',
                                ['user' => $app['user'],
                                 'podcast' => $podcast]);
  }

  public function donation(Application $app){
    return $app['twig']->render('donation.tpl', ['user' => $app['user']]);
  }

  public function online(Application $app){
    return $app['twig']->render('online.tpl', ['user' => $app['user']]);
  }
}