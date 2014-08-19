<?php namespace app\login\controllers;

use \boxxy\classes\di;
use \boxxy\classes\controller;
use \boxxy\interfaces\request;
use \app\conf;

class private_exit extends controller{

  public function execute(request $request){
    $em = di::get('em');
    $php = di::get('\app\php');
    $session = $em->find('\app\session\session', $php->get_cookie_value("uid"));
    $em->remove($session);
    $em->flush();
    setcookie("uid", "", strtotime('-30days'), '/', conf::host);
    $php->header('Location: /');
  }
}