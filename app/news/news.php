<?php namespace app\news;

class news {
  private $id;
  private $user;
  private $title;
  private $pubtime;
  private $description;
  private $rating;
  private $votes = [];

  /**
   * @param mixed $description
   */
  public function set_description($description)
  {
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
   */
  public function set_title($title)
  {
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
  public function set_votes(array $votes)
  {
    $this->votes = $votes;
  }

}