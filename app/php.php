<?php namespace app;

class php{

  public function readfile($file){
    readfile($file);
  }

  public function file_exists($file){
    return file_exists($file);
  }

  public function filesize($file){
    return filesize($file);
  }

  public function quit(){
    exit();
  }

  public function header($string){
    header($string);
  }

  public function session_destroy(){
    return session_destroy();
  }

  public function session_start(){
    return session_start();
  }

  public function get_session_value($value){
    if(isset($_SESSION[$value]))
      return $_SESSION[$value];
    else
      return null;
  }

  public function set_session_value($value, $key){
    $_SESSION[$value] = $key;
  }

  public function time(){
    return time();
  }

  public function mail($to, $theme, $message, $headers){
    return mail($to, $theme, $message, $headers);
  }
}