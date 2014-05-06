<?php namespace app;

use \boxxy\di;

class view{

  private $content = [];
  private $path;

  public function __construct(\boxxy\classes\controller $controller, \boxxy\classes\request $request){
    $this->content['user'] = di::get('user');
    $this->content['component'] = $controller->execute($request);
    $this->path = explode('\\', \get_class($controller));
  }

  public function render($root){
    $template_dir = $root.'templates/'.$this->path[1].'/';
    $loader = new \Twig_Loader_Filesystem($root.'templates/');
    $loader->prependPath($template_dir, $this->path[1]);
    $twig = new \Twig_Environment($loader);
    print $twig->render('@'.$this->path[1].'/'.$this->path[3].'.tpl', $this->content);
  }
}