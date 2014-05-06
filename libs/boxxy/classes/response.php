<?php namespace boxxy\classes;

class response{

  public function __construct($template, $content){
    $this->template = $template;
    $this->content = $content;
  }

  public function get_template(){
    return $this->template;
  }

  public function get_content(){
    return $this->content;
  }
}