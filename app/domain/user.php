<?php namespace app\domain;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Respect\Validation\Validator as v;
use DomainException;

/**
 * Class user
 * @package app\user
 * @Entity
 * @Table(name="users")
 */
class user{

  const nickname_re = '/^[а-яА-ЯёЁa-zA-Z0-9][а-яА-ЯёЁa-zA-Z0-9 ]{1,31}$/u';

  /**
   * @Id
   * @Column(name="id", type="smallint", nullable=false, options={"unsigned":true})
   * @GeneratedValue(strategy="AUTO")
   * @var int
   */
  private $id;
  /**
   * @Column(name="nickname", type="string", length=31)
   * @var string
   */
  private $nickname;
  /**
   * @Column(name="email", type="string", length=128)
   * @var string
   */
  private $email;
  /**
   * @Column(name="hash", type="string", length=40)
   * @var string
   */
  private $hash;
  /**
   * @Column(name="roles", type="simple_array", length=65535, nullable=true)
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
    if(!v::email()->validate($email))
      throw new DomainException();
    $this->email = $email;
  }

  public function set_id($id){
    $this->id = $id;
  }

  public function set_nickname($nickname){
    if(!preg_match(self::nickname_re, $nickname))
      throw new DomainException('Wrong user firstname '.$nickname);
    $this->nickname = $nickname;
  }

  public function set_hash($hash){
    $this->hash = $hash;
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