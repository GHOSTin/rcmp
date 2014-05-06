<?php namespace boxxy\classes;

use \boxxy\interfaces\request;
use \boxxy\classes\controller;

class response_example extends response{

  public function get_template_path(){
    $path = explode('\\', \get_class($this->controller));
    return '@'.$path[1].'/'.$path[3].'.tpl';
  }

  public function get_content(){
    return ['response' => $this->response,
      'request' => $this->request];
  }
}