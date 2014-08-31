<?php

namespace app\podcasts;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * Class podcasts
 * @package app\podcasts
 * @Entity()
 * @Table(name="podcasts")
 */
class podcast {

  /**
   * @Id()
   * @Column(name="time", type="bigint")
   * @var int
   */
  private $time;
  /**
   * @Column(name="name", type="string")
   * @var string
   */
  private $name;
  /**
   * @Column(name="alias", type="string", nullable=false)
   * @var string
   */
  private $alias;
  /**
   * @Column(name="url", type="string", nullable=true)
   * @var
   */
  private $url;

  public function set_alias($alias)
  {
    if(!preg_match('/[0-9a-zA-Z]+/', $alias))
      throw new \DomainException();
    $this->alias = $alias;
  }

  public function get_alias()
  {
    return $this->alias;
  }

  public function set_name($name)
  {
    $this->name = $name;
  }

  public function get_name()
  {
    return $this->name;
  }

  public function set_time($time)
  {
    $this->time = $time;
  }

  public function get_time()
  {
    return $this->time;
  }

  public function set_url($url)
  {
    if(preg_match_all('|^https?:\/\/\S+v=(\w+)|', $url, $args))
      $url = $args[1][0];
    $this->url = $url;
  }

  public function get_url()
  {
    return $this->url;
  }

} 