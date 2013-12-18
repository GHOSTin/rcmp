<?php namespace app;

class resolver{

  private $default;

  public function __construct(\app\controller $controller){
    $this->default = $controller;
  }
  
  public function get_controller(\app\request $request){
    $path = parse_url($_SERVER['REQUEST_URI']);
    // дефолтная страница
    if($path['path'] === '/')
      $route = ['default_page', 'show_default_page'];
    // страницы контроллера
    elseif(preg_match_all('|^/([a-z_]+)/$|', $path['path'], $args, PREG_PATTERN_ORDER)){
      $route = [$args[1][0], 'show_default_page'];
    }elseif(preg_match_all('|^/([a-z_]+)/([a-z_]+)[/]{0,1}$|', $path['path'], $args, PREG_PATTERN_ORDER)){
      $route = [$args[1][0], $args[2][0]];
    }else
      $route = ['error', 'error404'];

    if($this->is_logged_user($request))
      $class = '\app\\'.$route[0].'\\controllers\\private_'.$route[1];
    else
      $class = '\app\\'.$route[0].'\\controllers\\public_'.$route[1];
    if(class_exists($class))
      return new $class;
    else
      return $this->default;
  }

  public function is_logged_user(){
    if(isset($_SESSION['user']))
      return true;
    else
      return false;
  }
}