<?php namespace app\news;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use DomainException;


/**
 * Class news
 * @package app\news
 * @Entity(repositoryClass="\app\news\repository")
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
   * @ManyToOne(targetEntity="\app\user\user")
   * @var \app\user\user
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
   * @ManyToMany(targetEntity="\app\user\user")
   * @JoinTable(name="news2votes",
   *    joinColumns={@JoinColumn(name="news_id", referencedColumnName="id")},
   *    inverseJoinColumns={@JoinColumn(name="user_id", referencedColumnName="id")})
   */
  private $votes;

  /**
   * @param mixed $description
   * @throws \DomainException
   */
  public function set_description($description)
  {
    if(empty($description))
      throw new DomainException;
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
      throw new DomainException;
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
  public function set_user(\app\user\user $user)
  {
    $this->user = $user;
  }

  /**
   * @return \app\user\user
   */
  public function get_user()
  {
    return $this->user;
  }

  /**
   * @return array
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

}