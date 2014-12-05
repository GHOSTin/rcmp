<?php namespace app\domain;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;
use DomainException;

/**
 * Class news
 * @package app\news
 * @Entity()
 * @Table(name="news")
 */
class news {
  /** @Id
   * @Column(name="id", type="integer")
   * @GeneratedValue
   * @var int
   */
  private $id;

  /**
   * @ManyToOne(targetEntity="\app\domain\user")
   * @JoinColumn(name="user_id", referencedColumnName="id")
   * @var \app\domain\user
   */
  private $user;
  /**
   * @Column(name="title", type="string")
   * @var string
   */
  private $title;
  /**
   * @Column(name="pubtime", type="integer")
   * @var int
   */
  private $pubtime;
  /**
   * @Column(name="description", type="string")
   * @var string
   */
  private $description;
  /**
   * @Column(name="rating", type="integer")
   * @var int
   */
  private $rating;
  /**
   * @ManyToMany(targetEntity="\app\domain\user")
   * @JoinTable(name="news2votes",
   *    joinColumns={@JoinColumn(name="news_id", referencedColumnName="id")},
   *    inverseJoinColumns={@JoinColumn(name="user_id", referencedColumnName="id")})
   */
  private $votes;
  /**
   * @ManyToOne(targetEntity="\app\domain\podcast", inversedBy="news")
   * @JoinColumn(name="podcast_id", referencedColumnName="time")
   * @var \app\domain\podcast|null
   */
  private $podcast;
  /**
   * @param mixed $description
   * @throws \DomainException
   */
  public function set_description($description)
  {
    if(empty($description))
      throw new DomainException();
    $this->description = strip_tags(htmlspecialchars_decode($description));
  }

  /**
   * @return mixed
   */
  public function get_description()
  {
    return $this->description;
  }

  /**
   * @param mixed $id
   */
  public function set_id($id)
  {
    $this->id = $id;
  }

  /**
   * @return mixed
   */
  public function get_id()
  {
    return $this->id;
  }

  /**
   * @param mixed $pubtime
   */
  public function set_pubtime($pubtime)
  {
    $this->pubtime = $pubtime;
  }

  /**
   * @return mixed
   */
  public function get_pubtime()
  {
    return $this->pubtime;
  }

  /**
   * @param mixed $title
   * @throws \DomainException
   */
  public function set_title($title)
  {
    if(empty($title))
      throw new DomainException();
    $this->title = $title;
  }

  /**
   * @return mixed
   */
  public function get_title()
  {
    return $this->title;
  }

  /**
   * @param mixed $rating
   */
  public function set_rating($rating)
  {
    $this->rating = $rating;
  }

  /**
   * @return mixed
   */
  public function get_rating()
  {
    return (int)$this->rating;
  }

  /**
   * @param mixed $user
   */
  public function set_user(\app\domain\user $user)
  {
    $this->user = $user;
  }

  /**
   * @return \app\domain\user
   */
  public function get_user()
  {
    return $this->user;
  }

  /**
   * @return mixed
   */
  public function get_votes()
  {
    return $this->votes;
  }

  /**
   * @param array $votes
   */
  public function set_votes($votes)
  {
    $this->votes = $votes;
  }

  public function isVoted(user $user){
    if ($this->user == $user)
      return true;
    $votes = $this->votes;
    if($votes)
      return $votes->contains($user);
    return false;
  }

  /**
   * @param mixed $podcast
   */
  public function set_podcast(podcast $podcast = null)
  {
    $this->podcast = $podcast;
  }

  /**
   * @return mixed
   */
  public function get_podcast()
  {
    return $this->podcast;
  }

  public function get_urls(){
    preg_match_all('/\\[url=((?:ftp|https?):\\/\\/.*?)\\].*\\n?\\[\\/url\\]/',
        $this->description, $matches, PREG_PATTERN_ORDER );
    return isset($matches[1]) ? $matches[1] : array();
  }
}