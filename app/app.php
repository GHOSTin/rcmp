<?php
namespace app;

use \boxxy\classes\di;
use \PDO;
use \Doctrine\ORM\Tools\Setup;
use \Doctrine\ORM\EntityManager;

class app extends \boxxy\classes\app {
  public function execute_before_request_block(){
    $pimple = new \Pimple();
    $pimple['pdo'] = $pimple->share(function($pimple){
      $pdo = new PDO('mysql:host='. \app\conf::db_host.';dbname='. \app\conf::db_name, \app\conf::db_user, \app\conf::db_password);
      $pdo->exec("SET NAMES utf8");
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      return $pdo;
    });
    $pimple['em'] = $pimple->share(function($pimple){
      $paths = array(__DIR__);
      $isDevMode = (\app\conf::status == 'development')? true: false;
      $dbParams = array(
          'driver'   => 'pdo_mysql',
          'host'     => \app\conf::db_host,
          'user'     => \app\conf::db_user,
          'password' => \app\conf::db_password,
          'dbname'   => \app\conf::db_name,
      );

      $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
      return EntityManager::create($dbParams, $config);
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
    $pimple['\app\news\mapper'] = function ($pimple) {
      return new \app\news\mapper($pimple['pdo']);
    };
    $pimple['\app\news2votes\mapper'] = function ($pimple) {
      return new \app\news2votes\mapper($pimple['pdo']);
    };
    $pimple['\app\user\model'] = function ($pimple) {
      return new \app\user\model();
    };
    $pimple['\app\news\model'] = function ($pimple) {
      return new \app\news\model();
    };
    $pimple['\app\news2votes\model'] = function ($pimple) {
      return new \app\news2votes\model();
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

  public function get_view(){
    return new \app\view();
  }

  public function  get_resolver(){
    return new \app\resolver(
        new \app\errors\controllers\error404());
  }

  public function get_status(){
    return \app\conf::status;
  }

} 