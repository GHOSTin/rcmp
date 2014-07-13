<?php namespace boxxy\classes;

use \RuntimeException;

class view{

  public function render($root, request $request, array $response){
    require_once($root.'libs/Twig/Autoloader.php');
    \Twig_Autoloader::register();
    $templates = $root.'templates'.DIRECTORY_SEPARATOR;
    $path = parse_url($request->get_uri());
    if($path['path'] === '/')
      $route = ['default_page', 'show_default_page'];
    elseif(preg_match_all('|^/([0-9a-z_]+)/$|', $path['path'], $args, PREG_PATTERN_ORDER)){
      $route = [$args[1][0], 'show_default_page'];
    }elseif(preg_match_all('|^/([0-9a-z_]+)/([0-9a-z_]+)/$|', $path['path'], $args, PREG_PATTERN_ORDER)){
      $route = [$args[1][0], $args[2][0]];
    }else
      throw new RuntimeException;
    $template_name = $route[0].DIRECTORY_SEPARATOR.$route[1].'.tpl';
    $loader = new \Twig_Loader_Filesystem($templates);
    $loader->prependPath($templates.$route[0], $route[0]);
    $twig = new \Twig_Environment($loader);
    return $twig->render($template_name, $response);
  }
}