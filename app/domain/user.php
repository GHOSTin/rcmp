<?php namespace app\domain;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * Class user
 * @package app\user
 * @Entity
 * @Table(name="users")
 */
class user{

  /**
   * @Id
   * @Column(name="id", type="integer")
   * @GeneratedValue
   * @var int
   */
  private $id;
  /**
   * @Column(name="nickname", type="string")
   * @var string
   */
  private $nickname;
  /**
   * @Column(name="email", type="string")
   * @var string
   */
  private $email;
  /**
   * @Column(name="hash", type="string")
   * @var string
   */
  private $hash;
  /**
   * @Column(name="roles", type="simple_array")
   * @var array
   */
  private $roles;

  public function get_email(){
    return $this->email;
  }

  public function get_id(){
    return $this->id;
  }

  public function get_nickname(){
    return $this->nickname;
  }

  public function get_hash(){
    return $this->hash;
  }

  public function set_email($email){
    $this->email = (string) $email;
  }

  public function set_id($id){
    $this->id = (int) $id;
  }

  public function set_nickname($nickname){
    $this->nickname = (string) $nickname;
  }

  public function set_hash($hash){
    $this->hash = (string) $hash;
  }

  public function set_roles(array $roles)
  {
    foreach ($roles as $role) {
      if(!preg_match_all('/^podcast_admin|news_admin$/', $role))
        throw new \DomainException();
    }
    $this->roles = $roles;
  }

  public function get_roles()
  {
    return $this->roles;
  }

  public function isPodcastAdmin(){
    return in_array('podcast_admin', $this->roles);
  }

  public function isNewsAdmin(){
    return in_array('news_admin', $this->roles);
  }
}