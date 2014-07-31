<?php namespace boxxy\classes;

use \boxxy\classes\controller;

class resolver implements \boxxy\interfaces\resolver{

  private $default;
  private $uri;

  public function __construct(controller $controller){
    $this->default = $controller;
  }

  public function get_controller(\boxxy\interfaces\request $request){
    $path = parse_url($request->get_uri());
    if($path['path'] === '/')
      $route = ['default_page', 'show_default_page'];
    elseif(preg_match_all('|^/([a-z_]+)/$|', $path['path'], $args, PREG_PATTERN_ORDER)){
      $route = [$args[1][0], 'show_default_page'];
    }elseif(preg_match_all('|^/([a-z_]+)/([a-z_]+)/$|', $path['path'], $args, PREG_PATTERN_ORDER)){
      $route = [$args[1][0], $args[2][0]];
    }else
      return $this->default;
    $class = '\app\\'.$route[0].'\\controllers\\public_'.$route[1];
    if(class_exists($class))
      return new $class;
    else
      return $this->default;
  }
}