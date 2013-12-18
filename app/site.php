<?php namespace app;

class site{

  public function run(){
    session_start();
    $request = new \app\request();
    $resolver = new \app\resolver(new \app\errors\controllers\error404());
    $controller = $resolver->get_controller($request);
    $view = new \app\view($controller, $request);
    $view->render();
  }
}