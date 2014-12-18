<?php namespace app\domain;

use app\domain\podcast;
use app\domain\user;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\Mapping\Table;
use Gedmo\Mapping\Annotation\Tree;
use Gedmo\Mapping\Annotation\TreeLeft;
use Gedmo\Mapping\Annotation\TreeLevel;
use Gedmo\Mapping\Annotation\TreeParent;
use Gedmo\Mapping\Annotation\TreeRight;
use Gedmo\Mapping\Annotation\TreeRoot;

/**
 * Class comment
 * @package app\domain
 * @Tree(type="nested")
 * @Table(name="comments")
 * @Entity(repositoryClass="\app\repository\commentRepository")
 */
class comment {
  /**
   * @Id
   * @Column(name="id", type="bigint")
   * @GeneratedValue(strategy="AUTO")
   * @var
   */
  private $id;
  /**
   * @Column(name="text", type="text")
   * @var
   */
  private $text;
  /**
   * @Column(name="time", type="bigint")
   * @var
   */
  private $time;
  /**
   * @Column(name="status", type="string")
   * @var
   */
  private $status = 'active';
  /**
   * @TreeLeft
   * @Column(name="lft", type="integer")
   * @var
   */
  private $lft;
  /**
   * @TreeLevel
   * @Column(name="lvl", type="integer")
   * @var
   */
  private $lvl;
  /**
   * @TreeRight
   * @Column(name="rgt", type="integer")
   * @var
   */
  private $rgt;
  /**
   * @TreeRoot
   * @Column(name="root", type="integer", nullable=true)
   * @var
   */
  private $root;
  /**
   * @TreeParent
   * @ManyToOne(targetEntity="\app\domain\comment", inversedBy="children")
   * @JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
   * @var
   */
  private $parent;
  /**
   * @OneToMany(targetEntity="\app\domain\comment", mappedBy="parent")
   * @OrderBy({"rgt" = "ASC"})
   * @var
   */
  private $children;
  /**
   * @ManyToOne(targetEntity="\app\domain\user")
   * @JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
   * @var user
   */
  private $user;
  /**
   * @ManyToOne(targetEntity="\app\domain\podcast", inversedBy="comments")
   * @JoinColumn(name="podcast_id", referencedColumnName="id", nullable=false)
   * @var podcast
   */
  private $podcast;

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

  /**
   * @return mixed
   */
  public function get_text()
  {
    return $this->text;
  }

  /**
   * @param mixed $text
   */
  public function set_text($text)
  {
    $this->text = $text;
  }

  /**
   * @return mixed
   */
  public function get_parent()
  {
    return $this->parent;
  }

  /**
   * @param mixed $parent
   */
  public function set_parent(\app\domain\comment $parent = null)
  {
    $this->parent = $parent;
  }

  /**
   * @return mixed
   */
  public function get_time()
  {
    return $this->time;
  }

  /**
   * @param mixed $time
   */
  public function set_time($time)
  {
    $this->time = $time;
  }

  /**
   * @return mixed
   */
  public function get_status()
  {
    return $this->status;
  }

  /**
   * @param mixed $status
   */
  public function set_status($status)
  {
    $this->status = $status;
  }

  /**
   * @return user
   */
  public function get_user()
  {
    return $this->user;
  }

  /**
   * @param user $user
   */
  public function set_user(user $user)
  {
    $this->user = $user;
  }

  /**
   * @return podcast
   */
  public function get_podcast()
  {
    return $this->podcast;
  }

  /**
   * @param podcast $podcast
   */
  public function set_podcast(podcast $podcast)
  {
    $this->podcast = $podcast;
  }

  /**
   * @return mixed
   */
  public function get_children()
  {
    return $this->children;
  }

}