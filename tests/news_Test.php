<?php

use app\domain\news;
use app\domain\user;
use app\domain\podcast;
use Doctrine\Common\Collections\ArrayCollection;

class news_Test extends PHPUnit_Framework_TestCase{

  public function setUp(){
    $this->news = new news();
  }

  public function test_id(){
    $this->news->set_id(123);
    $this->assertEquals(123, $this->news->get_id());
  }

  public function test_pubtime(){
    $this->news->set_pubtime(1397562800);
    $this->assertEquals(1397562800, $this->news->get_pubtime());
  }

  public function test_title_1(){
    $this->news->set_title('Привет');
    $this->assertEquals('Привет', $this->news->get_title());
  }

  public function test_title_2(){
    $this->setExpectedException('DomainException');
    $this->news->set_title('');
  }

  public function test_rating(){
    $this->news->set_rating(1);
    $this->assertEquals(1, $this->news->get_rating());
  }

  public function test_user(){
    $user = new user();
    $this->news->set_user($user);
    $this->assertEquals($user, $this->news->get_user());
  }

  public function test_description_1(){
    $this->news->set_description('Описание');
    $this->assertEquals('Описание', $this->news->get_description());
  }

  public function test_description_2(){
    $this->setExpectedException('DomainException');
    $this->news->set_description('');
  }

  public function test_podcast_1(){
    $podcast = new podcast();
    $this->news->set_podcast($podcast);
    $this->assertEquals($podcast, $this->news->get_podcast());
  }

  public function test_podcast_2(){
    $this->news->set_podcast(null);
    $this->assertEquals(null, $this->news->get_podcast());
  }

  public function test_votes(){
    $collection = new ArrayCollection();
    $this->news->set_votes($collection);
    $this->assertEquals($collection, $this->news->get_votes());
  }

  public function test_voted_1(){
    $user = new user();
    $this->news->set_user($user);
    $this->news->isVoted($user);
  }

  public function test_voted_2(){
    $user1 = new user();
    $user2 = new user();
    $user1->set_id(1);
    $user2->set_id(2);
    $collection = new ArrayCollection();
    $collection->add($user2);
    $this->news->set_user($user1);
    $this->news->set_votes($collection);
    $this->assertTrue($this->news->isVoted($user2));
  }
}