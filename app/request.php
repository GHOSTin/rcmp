<?php namespace app;

class request{

  public function GET($key){
    if(isset($_GET[$key]))
      return $_GET[$key];
    else
      return null;
  }

  public function POST($key){
    if(isset($_POST[$key]))
      return $_POST[$key];
    else
      return null;
  }

  public function FILES($key){
    return $_FILES[$key];
  }
}