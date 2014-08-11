<?php namespace app\news2votes;

use boxxy\classes\di;

class model {
  public function change($id){
    $mapper = di::get('\app\news2votes\mapper');
    $voted = $mapper->find($id);
    if(!in_array(di::get('user')->get_id(), $voted)){
      $mapper->insert($id);
      return true;
    }
    return false;
  }
} 