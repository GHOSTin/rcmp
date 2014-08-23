<?php namespace app;

use \RuntimeException;
use \boxxy\classes\di;
use \boxxy\classes\request;

class view extends \boxxy\classes\view {

  public function render($root, request $request, array $response){
    $response['user'] = di::get('user');
    \Twig_Autoloader::register();
    $templates = $root.'templates'.DIRECTORY_SEPARATOR;
    $path = parse_url($request->get_uri());
    if($path['path'] === '/')
      $route = ['default_page', 'show_default_page'];
    elseif(preg_match_all('|^/api/([0-9a-z]{40})/([a-z_]+)/$|', $path['path'], $args, PREG_PATTERN_ORDER)){
      $route = ['api', $args[2][0]];
    }elseif(preg_match_all('|^/([0-9a-z_]+)/$|', $path['path'], $args, PREG_PATTERN_ORDER)){
      $route = [$args[1][0], 'show_default_page'];
    }elseif(preg_match_all('|^/([0-9a-z_]+)/([0-9a-z_]+)/$|', $path['path'], $args, PREG_PATTERN_ORDER)){
      $route = [$args[1][0], $args[2][0]];
    }else
      throw new RuntimeException;
    $template_name = self::get_strong_name($route);
    $loader = new \Twig_Loader_Filesystem($templates);
    $loader->prependPath($templates.$route[0], $route[0]);
    $twig = new \Twig_Environment($loader);
    require_once($root.'libs/BBCodeExtension.php');
    $twig->addExtension(new \BBCodeExtension());
    return $twig->render($template_name, $response);
  }

  private function get_strong_name(array $route){
    if($route[0] === 'api')
      return DIRECTORY_SEPARATOR.$route[0].DIRECTORY_SEPARATOR.$route[1].'.tpl';
    if(!is_null(di::get('user')))
      return DIRECTORY_SEPARATOR.$route[0].DIRECTORY_SEPARATOR.'private_'.$route[1].'.tpl';
    else
      return DIRECTORY_SEPARATOR.$route[0].DIRECTORY_SEPARATOR.'public_'.$route[1].'.tpl';
  }
}