<?php namespace app\user;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
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
}