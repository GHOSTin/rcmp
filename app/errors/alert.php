<?php namespace app\errors;

use \exception;

class alert{

  public function __construct($string){
    throw new exception($string);
  }
}