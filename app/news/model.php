<?php namespace app\news;

use boxxy\classes\di;

class model {

  public function add_news($title, $description){
    $news = new \app\news\news();
    $em = di::get('em');
    $news->set_title($title);
    $news->set_description($description);
    $news->set_user(di::get('user'));
    $news->set_pubtime(time());
    $em->persist($news);
    $em->flush();
    return $news;
  }

  public function edit_news($id, $title, $description){
    $em = di::get('em');
    $news = $em->find('\app\news\news', $id);
    if($news->get_user() == di::get('user') or di::get('user')->isNewsAdmin()){
      $news->set_title($title);
      $news->set_description($description);
      $em->flush();
    }
    return $news;
  }

  public function delete_news($id){
    $em = di::get('em');
    $news = $em->find('\app\news\news', $id);
    if($news->get_user() == di::get('user') or di::get('user')->isNewsAdmin()){
      $em->remove($news);
      $em->flush();
      return $id;
    }
    return null;
  }

} 