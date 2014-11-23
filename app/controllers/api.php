<?php namespace app\controllers;

use Silex\Application;

class api{

  public function get_user_info(Application $app, $api_key){
    $session = $app['em']->getRepository('\app\domain\session')->find($api_key);
    $user = ($session)? $session->get_user(): null;
    return $app['twig']->render('api\get_user_info.tpl', ['user' => $user]);
  }

  public function get_user_list(Application $app, $api_key){
    $users = $app['em']->getRepository('\app\domain\user')->findAll();
    return $app['twig']->render('api\get_user_list.tpl', ['users' => $users]);
  }
}