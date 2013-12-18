<?php namespace app;

use \PDO;

class mapper{

  protected $pdo;

  public function __construct(PDO $pdo){
    $this->pdo = $pdo;
  }
}