<?php namespace app\domain;


use Doctrine\ORM\Mapping\GeneratedValue;
use DomainException;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * Class podcasts
 * @package app\podcasts
 * @Entity()
 * @Table(name="podcasts")
 */
class podcast {

  const alias_re = '/^[0-9a-zA-Z]{2,16}$/';
  const name_re = '/^[а-яА-ЯёЁa-zA-Z0-9 !?.,;&"“”-]{1,255}$/u';

  /**
   * @Id()
   * @GeneratedValue(strategy="AUTO")
   * @Column(name="id", type="integer", options={"unsigned":true})
   * @var
   */
  private $id;
  /**
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
   * @Column(name="shownotes", type="text", nullable=true)
   * @var string
   */
  private $shownotes;
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

  /**
  * @Column(name="file_url", type="text", nullable=true)
  * @var string
  */
  private $file_url;
  /**
   * @OneToMany(targetEntity="\app\domain\comment", mappedBy="podcast")
   * @var \app\domain\podcast
   */
  private $comments;

  public function __construct(){
    $this->news = new ArrayCollection();
    $this->comments = new ArrayCollection();
  }

  /**
   * @return mixed
   */
  public function get_id()
  {
    return $this->id;
  }

  /**
   * @param mixed $id
   */
  public function set_id($id)
  {
    $this->id = $id;
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

  public function set_file_url($url = null){
    $this->file_url = $url;
  }

  public function get_file_url(){
    return $this->file_url;
  }

  /**
   * @return string
   */
  public function get_shownotes()
  {
    return $this->shownotes;
  }

  /**
   * @param string $shownotes
   */
  public function set_shownotes($shownotes = null)
  {
    $this->shownotes = $shownotes;
  }
  /**
   * @return podcast
   */
  public function get_comments()
  {
    return $this->comments;
  }

  /**
   * @param podcast $comments
   */
  public function set_comments($comments)
  {
    $this->comments = $comments;
  }
}