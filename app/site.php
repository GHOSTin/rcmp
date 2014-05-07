<?php namespace app;

use \PDO;
use \boxxy\di;

class site{

  public function run($root){
    $this->init();
    $request = new \boxxy\classes\request();
    if(!empty($_GET))
      foreach($_GET as $key => $value)
        $request->set_property($key, $value);
    if(!empty($_POST))
      foreach($_POST as $key => $value)
        $request->set_property($key, $value);
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
    $pimple['\app\user\factory'] = function ($pimple) {
      return new \app\user\factory();
    };
    $pimple['\app\user\mapper'] = function ($pimple) {
      return new \app\user\mapper($pimple['pdo']);
    };
    $pimple['\app\user\model'] = function ($pimple) {
      return new \app\user\model();
    };
    di::set_instance($pimple);
    $php = di::get('\app\php');
    if(isset($_COOKIE['uid'])){
      $user = di::get('\app\user\mapper')->find_by_session($_COOKIE['uid']);
      if(is_null($user)){
        setcookie("uid", "", time() - 3600, '/');
        $pimple['user'] = null;
      }else
        $pimple['user'] = $user;
    }else
      $pimple['user'] = null;
  }
}