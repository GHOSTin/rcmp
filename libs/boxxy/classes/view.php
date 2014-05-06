<?php namespace boxxy\classes;

use \boxxy\classes\response;

class view{

  private $dir;

  public function __construct($dir){
    $this->dir = $dir;
  }

  public function render($response){
    $tdir = explode('/', substr($response->get_template(), 1))[0];
    $loader = new \Twig_Loader_Filesystem($this->dir);
    $loader->prependPath($this->dir.$tdir, $tdir);
    $twig = new \Twig_Environment($loader);
    return $twig->render($response->get_template(), $response->get_content());
  }
}