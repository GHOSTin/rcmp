<?php namespace app\news2votes;

use \boxxy\classes\di;
use \boxxy\classes\mapper_pdo;
use \PDO;
use \RuntimeException;

class mapper extends mapper_pdo {
  private static $find = "SELECT GROUP_CONCAT(DISTINCT `user_id`) FROM `news2votes` WHERE `news_id` = :id GROUP BY `news_id`";

  private static $insert = "INSERT INTO news2votes SET news_id = :news_id, user_id = :user_id";

  private static $delete = "DELETE FROM news2votes WHERE news_id = :id";

  public function find($news_id){
    $stmt = $this->pdo->prepare(self::$find);
    $stmt->bindValue(':id', $news_id, PDO::PARAM_INT);
    if(!$stmt->execute())
      throw new RuntimeException;
    $count = $stmt->rowCount();
    if($count > 1)
      throw new RuntimeException;
    $data = $stmt->fetchColumn(0);
    if(strlen($data) > 0)
      return explode(',', $data);
    else
      return [];
  }

  public function insert($news_id){
    $stmt = $this->pdo->prepare(self::$insert);
    $stmt->bindValue(':news_id', $news_id, PDO::PARAM_INT);
    $stmt->bindValue(':user_id',  di::get('user')->get_id(), PDO::PARAM_INT);
    if(!$stmt->execute())
      throw new RuntimeException;
  }

  public function delete($news_id){
    $stmt = $this->pdo->prepare(self::$delete);
    $stmt->bindValue(':id', $news_id, PDO::PARAM_INT);
    if(!$stmt->execute())
      throw new RuntimeException;
  }

} 