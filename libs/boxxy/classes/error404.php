<?php namespace boxxy\classes;

class error404 extends controller{

  public function execute(\boxxy\interfaces\request $request){
    header("HTTP/1.0 404 Not Found");
    print(404);
    exit();
  }
}