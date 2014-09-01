<?php
namespace app;

use \boxxy\classes\di;
use \PDO;
use \Doctrine\ORM\Tools\Setup;
use \Doctrine\ORM\EntityManager;
use \Pimple\Container as Pimple;

class app extends \boxxy\classes\app {
  public function execute_before_request_block(){
    $pimple = new Pimple();
    $paths = array(__DIR__);
    $isDevMode = (\app\conf::status == 'development')? true: false;
    $dbParams = array(
        'driver'   => 'pdo_mysql',
        'host'     => \app\conf::db_host,
        'user'     => \app\conf::db_user,
        'password' => \app\conf::db_password,
        'dbname'   => \app\conf::db_name,
        'charset'  => 'utf8'
    );
    $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
    $pimple['em'] = EntityManager::create($dbParams, $config);

    $pimple['\app\php'] = function ($pimple) {
      return new \app\php();
    };
    $pimple['\app\user\model'] = function ($pimple) {
      return new \app\user\model();
    };
    $pimple['\app\news\model'] = function ($pimple) {
      return new \app\news\model();
    };
    di::set_instance($pimple);
    if(isset($_COOKIE['uid'])){
      $session = di::get('em')->find('\app\session\session', $_COOKIE['uid']);
      if(is_null($session)){
        setcookie("uid", "", time() - 3600, '/');
        $pimple['user'] = null;
      }else
        $pimple['user'] = $session->get_user();
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