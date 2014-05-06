<?php namespace app\user;

class factory{

  public function build(array $row){
    $user = new user();
    $user->set_id($row['id']);
    $user->set_nickname($row['nickname']);
    $user->set_email($row['email']);
    $user->set_hash($row['hash']);
    return $user;
  }
}