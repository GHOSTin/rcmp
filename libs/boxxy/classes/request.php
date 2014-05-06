<?php namespace boxxy\classes;

class request implements \boxxy\interfaces\request{

  private $properties;

  public function __construct(){
    if(!empty($_GET))
        foreach($_GET as $key => $value)
          $this->set_property($key, $value);
    if(!empty($_POST))
        foreach($_POST as $key => $value)
          $this->set_property($key, $value);
  }

  public function set_property($key, $value){
    $this->properties[$key] = $value;
  }

  public function get_property($key){
    if(isset($this->properties[$key]))
      return $this->properties[$key];
    else
      return null;
  }

  public function get_uri(){
    return $_SERVER['REQUEST_URI'];
  }

  public function get_host(){
    return $_SERVER['SERVER_NAME'];
  }

  public function get_files(){
    return $_FILES;
  }
}