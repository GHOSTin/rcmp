<?php namespace app\news;

use boxxy\classes\di;

class model {

  public function add_news($title, $description){
    $news = new \app\news\news();
    $em = di::get('em');
    $news->set_title($title);
    $news->set_description($description);
    $news->set_user(di::get('em')->find('\app\user\user', 1));
    $news->set_pubtime(time());
    $em->persist($news);
    $em->flush();
    return $news;
  }

  public function edit_news($id, $title, $description){
    $mapper = di::get('\app\news\mapper');
    $news = $mapper->find_by_id($id);
    if($news->get_user()->get_id() != di::get('user')->get_id())
      return $news;
    $news->set_title($title);
    $news->set_description($description);
    $mapper->update($news);
    return $news;
  }

  public function delete_news($id){
    $mapper = di::get('\app\news\mapper');
    $pdo = di::get('pdo');
    $pdo->beginTransaction();
    $news = $mapper->find_by_id($id);
    if($news->get_user()->get_id() != di::get('user')->get_id())
      return $news;
    $mapper->delete($id);
    di::get('\app\news2votes\mapper')->delete($id);
    $pdo->commit();
    return $id;
  }

} 