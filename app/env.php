<?php namespace app;

class env{

  private static $twig;
  private static $pdo;

  public static function get_twig(){
    if(is_null(self::$twig))
      try{
        require_once ROOT.'libs/Twig/Autoloader.php';
        \Twig_Autoloader::register();
        $loader = new \Twig_Loader_Filesystem(ROOT.'app/templates/');
        self::$twig = new \Twig_Environment($loader);
      }catch(exception $e){
        die('Шаблонизатор не загрузился.');
      }
    return self::$twig;
  }

  public static function get_pdo(){
    if(is_null(self::$pdo))
      self::$pdo = new \PDO('mysql:host='.\app\conf::db_host.';dbname='.\app\conf::db_name,
        \app\conf::db_user, \app\conf::db_password, $options = []);
    if(!(self::$pdo instanceof \PDO))
      throw new exception('database not connected/');
    self::$pdo->exec("SET NAMES utf8");
    self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    self::$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    return self::$pdo;
  }
}