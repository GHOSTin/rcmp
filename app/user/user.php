<?php namespace app\user;

class user{

  private $id;
  private $nickname;
  private $email;
  private $hash;

  public function get_email(){
    return $this->email;
  }

  public function get_id(){
    return $this->id;
  }

  public function get_nickname(){
    return $this->nickname;
  }

  public function get_hash(){
    return $this->hash;
  }

  public function set_email($email){
    $this->email = (string) $email;
  }

  public function set_id($id){
    $this->id = (int) $id;
  }

  public function set_nickname($nickname){
    $this->nickname = (string) $nickname;
  }

  public function set_hash($hash){
    $this->hash = (string) $hash;
  }
}