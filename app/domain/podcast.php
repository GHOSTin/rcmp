<?php namespace app\domain;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
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
   * @Column(name="time", type="bigint", options={"unsigned":true})
   * @var int
   */
  private $time;
  /**
   * @Column(name="name", type="text", length=255)
   * @var string
   */
  private $name;
  /**
   * @Column(name="alias", type="text", length=255, nullable=false)
   * @var string
   */
  private $alias;
  /**
   * @Column(name="url", type="text", length=255, nullable=true)
   * @var
   */
  private $url;
  /**
   * @OneToMany(targetEntity="\app\domain\news", mappedBy="podcast")
   * @var
   */
  private $news;
  /**
   * @Column(name="showing", type="smallint", options={"default": 0})
   * @var
   */
  private $showPodcast = 0;

  public function __construct(){
    $this->news = new \Doctrine\Common\Collections\ArrayCollection();
  }

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

  /**
   * @param mixed $news
   */
  public function set_news($news)
  {
    $this->news = $news;
  }

  /**
   * @return mixed
   */
  public function get_news()
  {
    return $this->news;
  }

  public function add_news(\app\domain\news $news)
  {
    $this->news->add($news);
  }

  /**
   * @return mixed
   */
  public function get_showPodcast()
  {
    return $this->showPodcast;
  }

  /**
   * @param mixed $showPodcast
   */
  public function set_showPodcast($showPodcast)
  {
    $this->showPodcast = $showPodcast;
  }

  public function isShowPodcast(){
    return (boolean)$this->showPodcast;
  }

}