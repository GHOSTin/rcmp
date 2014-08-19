<?php namespace app\news\controllers;

use \boxxy\classes\controller;
use \boxxy\classes\di;
use \boxxy\interfaces\request;
use Doctrine\ORM\Query\ResultSetMapping;

class public_show_default_page extends controller{

  public function execute(request $request){
    $rsm = new ResultSetMapping;
    $rsm->addEntityResult('\app\news\news', 'n');
    $rsm->addFieldResult('n', 'id', 'id');
    $rsm->addFieldResult('n', 'title', 'title');
    $rsm->addFieldResult('n', 'pubtime', 'pubtime');
    $rsm->addFieldResult('n', 'description', 'description');
    $rsm->addFieldResult('n', 'rating', 'rating');
    $rsm->addMetaResult('n', 'user_id', 'user_id');

    $query = di::get('em')->createNativeQuery("SELECT id, user_id, title, pubtime, description, rating FROM news n
     WHERE TIMESTAMPDIFF(DAY, FROM_UNIXTIME(n.pubtime, '%Y-%m-%d 00:00:00'), CURDATE())
      <= MOD(3+WEEKDAY(NOW()), 7) ORDER BY n.pubtime", $rsm);
    //$q = di::get('em')->getRepository('\app\news\repository')->find_actual_news();
    var_dump($query->getResult()[1]->get_votes()[0]->get_nickname());
    exit();
    return null;
  }
}