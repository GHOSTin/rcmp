<?php namespace app;

class view{

  private $content = [];
  private $path;

  public function __construct(\app\controller $controller, \app\request $request){
    if(isset($_SESSION['user']))
      $this->content['user'] = $_SESSION['user'];
    $this->content['component'] = $controller->execute($request);
    $this->path = explode('\\', \get_class($controller));
  }

  public function render(){
    $template_dir = ROOT.'templates/'.$this->path[1].'/';
    require_once ROOT.'libs/Twig/Autoloader.php';
    \Twig_Autoloader::register();
    $loader = new \Twig_Loader_Filesystem(ROOT.'templates/');
    $loader->prependPath($template_dir, $this->path[1]);
    $twig = new \Twig_Environment($loader);
    print $twig->render('@'.$this->path[1].'/'.$this->path[3].'.tpl', $this->content);
  }
}