<?php namespace app\domain;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="sessions")
 * Class session
 * @package app\session
 */
class session {

  /**
   * @Id
   * @Column(name="session")
   * @var string
   */
  private $session;
  /**
   * @ManyToOne(targetEntity="\app\domain\user")
   * @var \app\domain\user
   */
  private $user;

  /**
   * @param mixed $session
   */
  public function set_session($session)
  {
    $this->session = $session;
  }

  /**
   * @return mixed
   */
  public function get_session()
  {
    return $this->session;
  }

  /**
   * @param mixed $user
   */
  public function set_user($user)
  {
    $this->user = $user;
  }

  /**
   * @return mixed
   */
  public function get_user()
  {
    return $this->user;
  }

}