<?php namespace app\repository;

use app\domain\podcast;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

class commentRepository extends NestedTreeRepository {

  public function getRootNodesQueryBuilderByPodcast(podcast $podcast, $sortByField = null, $direction = 'asc')
  {
    $meta = $this->getClassMetadata();
    $config = $this->listener->getConfiguration($this->_em, $meta->name);
    $qb = $this->getQueryBuilder();
    $qb
        ->select('node')
        ->from($config['useObjectClass'], 'node')
        ->where($qb->expr()->isNull('node.'.$config['parent']))
        ->andWhere($qb->expr()->eq('node.podcast', $podcast->get_id()))
    ;

    if ($sortByField !== null) {
      $qb->orderBy('node.'.$sortByField, strtolower($direction) === 'asc' ? 'asc' : 'desc');
    } else {
      $qb->orderBy('node.'.$config['left'], 'ASC');
    }

    return $qb;
  }

  /**
   * {@inheritDoc}
   */
  public function getRootNodesQueryByPodcast(podcast $podcast, $sortByField = null, $direction = 'asc')
  {
    return $this->getRootNodesQueryBuilderByPodcast($podcast, $sortByField, $direction)->getQuery();
  }

  /**
   * {@inheritDoc}
   */
  public function getRootNodesByPodcast(podcast $podcast, $sortByField = null, $direction = 'asc')
  {
    return $this->getRootNodesQueryByPodcast($podcast, $sortByField, $direction)->getResult();
  }
}