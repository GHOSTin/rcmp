<?php namespace app\domain;


use DomainException;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use \Doctrine\Common\Collections\ArrayCollection;
use app\domain\news;

/**
 * Class podcasts
 * @package app\podcasts
 * @Entity()
 * @Table(name="podcasts")
 */
class podcast {

  const alias_re = '/^[0-9a-zA-Z]{2,16}$/';
  const name_re = '/^[а-яА-ЯёЁa-zA-Z0-9 !?.,"-]{1,255}$/u';

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
  /**
   * @OneToMany(targetEntity="\app\domain\news", mappedBy="podcast")
   * @var
   */
  private $news;
  /**
   * @Column(name="showing", type="integer", options={"default":0})
   * @var
   */
  private $showPodcast = 0;

  public function __construct(){
    $this->news = new ArrayCollection();
  }

  public function set_alias($alias)
  {
    if(!preg_match(self::alias_re, $alias))
      throw new DomainException();
    $this->alias = $alias;
  }

  public function get_alias()
  {
    return $this->alias;
  }

  public function set_name($name)
  {
    if(!preg_match(self::name_re, $name))
      throw new DomainException();
    $this->name = $name;
  }

  public function get_name()
  {
    return $this->name;
  }

  public function set_time($time)
  {
    if($time < 1)
      throw new DomainException();
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
    if(!in_array($showPodcast, [0, 1], true))
      throw new DomainException();
    $this->showPodcast = $showPodcast;
  }

  public function isShowPodcast(){
    return (boolean) $this->showPodcast;
  }
}