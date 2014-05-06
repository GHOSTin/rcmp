<?php namespace app;

use \PDO;
use \boxxy\di;

class site{

  public function run($root){
    $this->init();
    $request = new \app\request();
    $resolver = new \app\resolver(new \app\errors\controllers\error404());
    $controller = $resolver->get_controller($request);
    $view = new \app\view($controller, $request);
    $view->render($root);
  }

  public function init(){
    $pimple = new \Pimple();

    $pimple['pdo'] = $pimple->share(function($pimple){
      $pdo = new PDO('mysql:host='.\app\conf::db_host.';dbname='.\app\conf::db_name, \app\conf::db_user, \app\conf::db_password);
      $pdo->exec("SET NAMES utf8");
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      return $pdo;
    });

    $pimple['\app\php'] = function ($pimple) {
      return new \app\php();
    };

    $pimple['\app\user\mapper'] = function ($pimple) {
      return new \app\user\mapper($pimple['pdo']);
    };

    di::set_instance($pimple);
    di::get('\app\php')->session_start();
  }
}