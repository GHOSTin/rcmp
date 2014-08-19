<?php namespace app\news;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class repository extends EntityRepository {

  public function find_actual_news(){
    $rsm = new ResultSetMapping;
    $rsm->addEntityResult('\app\news\news', 'n');
    $rsm->addFieldResult('n', 'id', 'id');
    $rsm->addFieldResult('n', 'title', 'title');
    $rsm->addFieldResult('n', 'pubtime', 'pubtime');
    $rsm->addFieldResult('n', 'description', 'description');
    $rsm->addFieldResult('n', 'rating', 'rating');
    $rsm->addMetaResult('n', 'user_id', 'user_id');

    $query = $this->_em->createNativeQuery("SELECT id, user_id, title, pubtime, description, rating FROM news n
     WHERE TIMESTAMPDIFF(DAY, FROM_UNIXTIME(n.pubtime, '%Y-%m-%d 00:00:00'), CURDATE())
      <= MOD(3+WEEKDAY(NOW()), 7)", $rsm);

    return $query->getResult();
  }

  public function find_history_news(){
    $rsm = new ResultSetMapping;
    $rsm->addEntityResult('\app\news\news', 'n');
    $rsm->addFieldResult('n', 'id', 'id');
    $rsm->addFieldResult('n', 'title', 'title');
    $rsm->addFieldResult('n', 'pubtime', 'pubtime');
    $rsm->addFieldResult('n', 'description', 'description');
    $rsm->addFieldResult('n', 'rating', 'rating');
    $rsm->addMetaResult('n', 'user_id', 'user_id');

    $query = $this->_em->createNativeQuery("SELECT id, user_id, title, pubtime, description, rating FROM news n
     WHERE TIMESTAMPDIFF(DAY, FROM_UNIXTIME(n.pubtime, '%Y-%m-%d 00:00:00'), CURDATE())
      > MOD(3+WEEKDAY(NOW()), 7)", $rsm);

    return $query->getResult();
  }

} 