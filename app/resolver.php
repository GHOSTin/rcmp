<?php namespace app;

use \boxxy\di;
use \boxxy\classes\controller;
use \boxxy\classes\request;

class resolver{

  private $default;

  public function __construct(controller $controller){
    $this->default = $controller;
  }

  public function get_controller(request $request){
    $path = parse_url($_SERVER['REQUEST_URI']);
    // дефолтная страница
    if($path['path'] === '/')
      $class = $this->get_strong_name(['default_page', 'show_default_page']);
    elseif(preg_match_all('|^/api/([0-9a-z]{40})/([a-z_]+)/$|', $path['path'], $args, PREG_PATTERN_ORDER)){
      $request->set_property('key', $args[1][0]);
      $class = $this->get_simple_name(['api', $args[2][0]]);
    }elseif(preg_match_all('|^/([a-z_]+)/$|', $path['path'], $args, PREG_PATTERN_ORDER)){
      $class = $this->get_strong_name([$args[1][0], 'show_default_page']);
    }elseif(preg_match_all('|^/([a-z_]+)/([a-z_]+)[/]{0,1}$|', $path['path'], $args, PREG_PATTERN_ORDER)){
      $class = $this->get_strong_name([$args[1][0], $args[2][0]]);
    }
    if(class_exists($class))
      return new $class;
    else
      return $this->default;
  }

  public function get_simple_name(array $route){
    return '\app\\'.$route[0].'\\controllers\\'.$route[1];
  }

  public function get_strong_name(array $route){
    if(!is_null(di::get('user')))
      return '\app\\'.$route[0].'\\controllers\\private_'.$route[1];
    else
      return '\app\\'.$route[0].'\\controllers\\public_'.$route[1];
  }
}