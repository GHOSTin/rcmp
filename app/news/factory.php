<?php namespace app\news;


use boxxy\classes\di;

class factory implements \boxxy\interfaces\factory {

  public function build(array $data){
    $news = new \app\news\news();
    $news->set_id($data['id']);
    $news->set_title($data['title']);
    $news->set_pubtime($data['pubtime']);
    $news->set_description($data['description']);
    $news->set_rating($data['rating']);
    $news->set_votes($data['votes']);
    $user = di::get('\app\user\mapper')->find_by_id($data['user_id']);
    $news->set_user($user);
    return $news;
  }
}