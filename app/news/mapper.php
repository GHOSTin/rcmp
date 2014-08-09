<?php namespace app\news;

use boxxy\classes\di;
use \PDO;
use boxxy\classes\mapper_pdo;
use RuntimeException;

class mapper extends mapper_pdo {

  private static $find_by_id = "SELECT * FROM news
   WHERE id = :id";

  private static $actual_news = "SELECT * FROM news
   WHERE TIMESTAMPDIFF(DAY, FROM_UNIXTIME(`pubtime`, '%Y-%m-%d 00:00:00'), NOW()) <= MOD(3+WEEKDAY(NOW()), 7) ORDER BY pubtime";

  private static $history_news = "SELECT * FROM news
   WHERE TIMESTAMPDIFF(DAY, FROM_UNIXTIME(`pubtime`, '%Y-%m-%d 00:00:00'), NOW()) > MOD(3+WEEKDAY(NOW()), 7) ORDER BY pubtime";

  private static $id = "SELECT id FROM news ORDER BY id DESC LIMIT 1";

  private static $insert = "INSERT INTO news SET rating = :rating,
   title = :title, description = :description, user_id = :user_id, pubtime = :pubtime";

  private static $update = "UPDATE news SET rating = :rating,
   title = :title, description = :description, user_id = :user_id, pubtime = :pubtime WHERE id = :id";

  private static $delete = "DELETE FROM news WHERE id = :id";

  public function get_id(){
    $stmt = $this->pdo->prepare(self::$id);
    if(!$stmt->execute())
      throw new RuntimeException;
    $id = $stmt->fetch()[0];
    return $id+1;
  }

  public function find_actual_news(){
    $stmt = $this->pdo->prepare(self::$actual_news);
    if(!$stmt->execute())
      throw new RuntimeException;
    $news = [];
    while($row = $stmt->fetch()) {
      $row['votes'] = di::get('\app\news2votes\mapper')->find($row['id']);
      $news[] = di::get('\app\news\factory')->build($row);
    }
    return $news;
  }

  public function find_history_news(){
    $stmt = $this->pdo->prepare(self::$history_news);
    if(!$stmt->execute())
      throw new RuntimeException;
    $news = [];
    while($row = $stmt->fetch()) {
      $row['votes'] = di::get('\app\news2votes\mapper')->find($row['id']);
      $news[] = di::get('\app\news\factory')->build($row);
    }
    return $news;
  }

  public function find_by_id($id){
    $stmt = $this->pdo->prepare(self::$find_by_id);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    if(!$stmt->execute())
      throw new RuntimeException;
    $count = $stmt->rowCount();
    if($count === 0)
      return null;
    elseif($count === 1) {
      $data = $stmt->fetch();
      $data['votes'] = di::get('\app\news2votes\mapper')->find($data['id']);
      return di::get('\app\news\factory')->build($data);
    }
    else
      throw new RuntimeException;
  }

  public function insert(\app\news\news $news){
    $stmt = $this->pdo->prepare(self::$insert);
    $stmt->bindValue(':title', $news->get_title(), PDO::PARAM_STR);
    $stmt->bindValue(':description', htmlspecialchars($news->get_description()), PDO::PARAM_STR);
    $stmt->bindValue(':pubtime', $news->get_pubtime(), PDO::PARAM_INT);
    $stmt->bindValue(':user_id', $news->get_user()->get_id(), PDO::PARAM_INT);
    $stmt->bindValue(':rating', $news->get_rating(), PDO::PARAM_INT);
    if(!$stmt->execute())
      throw new RuntimeException();
    return $this->pdo->lastInsertId();
  }

  public function update(\app\news\news $news){
    $stmt = $this->pdo->prepare(self::$update);
    $stmt->bindValue(':id', $news->get_id(), PDO::PARAM_INT);
    $stmt->bindValue(':title', $news->get_title(), PDO::PARAM_STR);
    $stmt->bindValue(':description', htmlspecialchars($news->get_description()), PDO::PARAM_STR);
    $stmt->bindValue(':pubtime', $news->get_pubtime(), PDO::PARAM_INT);
    $stmt->bindValue(':user_id', $news->get_user()->get_id(), PDO::PARAM_INT);
    $stmt->bindValue(':rating', $news->get_rating(), PDO::PARAM_INT);
    if(!$stmt->execute())
      throw new RuntimeException();
  }

  public function delete($id){
    $stmt = $this->pdo->prepare(self::$delete);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    if(!$stmt->execute())
      throw new RuntimeException();
  }

} 