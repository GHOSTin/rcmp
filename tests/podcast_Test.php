<?php

use app\domain\podcast;
use app\domain\news;

class podcast_Test extends PHPUnit_Framework_TestCase{

  public function setUp(){
    $this->podcast = new podcast();
  }

  public function test_alias_1(){
    $this->podcast->set_alias('430podcast');
    $this->assertEquals('430podcast', $this->podcast->get_alias());
  }

  public function test_alias_2(){
    $this->setExpectedException('DomainException');
    $this->podcast->set_alias('430 podcast');
  }

  public function test_alias_3(){
    $this->setExpectedException('DomainException');
    $this->podcast->set_alias('430подкаст');
  }

  public function test_alias_4(){
    $this->setExpectedException('DomainException');
    $this->podcast->set_alias('4');
  }

  public function test_alias_5(){
    $this->podcast->set_alias('430podcastPart2');
    $this->assertEquals('430podcastPart2', $this->podcast->get_alias());
  }

  public function test_alias_6(){
    $this->setExpectedException('DomainException');
    $this->podcast->set_alias('430podcastpodcast');
  }

  public function test_name_1(){
    $this->podcast->set_name('Корпоративный надзиратель - .,ЙЁшкорлаstripcode!?"');
    $this->assertEquals('Корпоративный надзиратель - .,ЙЁшкорлаstripcode!?"',
                        $this->podcast->get_name());
  }

  public function test_name_2(){
    $this->setExpectedException('DomainException');
    $this->podcast->set_name('');
  }

  public function test_name_3(){
    $this->setExpectedException('DomainException');
    $this->podcast->set_name('П'.str_repeat('привет123', 32));
  }

  public function test_time_1(){
    $this->podcast->set_time(1397562800);
    $this->assertEquals(1397562800, $this->podcast->get_time());
  }

  public function test_time_2(){
    $this->setExpectedException('DomainException');
    $this->podcast->set_time(0);
  }

  public function test_time_3(){
    $this->setExpectedException('DomainException');
    $this->podcast->set_time('');
  }

  public function test_time_4(){
    $this->setExpectedException('DomainException');
    $this->podcast->set_time(null);
  }

  public function test_url_1(){
    $this->podcast->set_url('http://www.youtube.com/watch?v=uGxnlbSGs1M');
    $this->assertEquals('uGxnlbSGs1M', $this->podcast->get_url());
  }

  public function test_url_2(){
    $this->podcast->set_url('https://www.youtube.com/watch?v=uGxnlbSGs1M');
    $this->assertEquals('uGxnlbSGs1M', $this->podcast->get_url());
  }

  public function test_url_3(){
    $this->podcast->set_url('uGxnlbSGs1M');
    $this->assertEquals('uGxnlbSGs1M', $this->podcast->get_url());
  }

  public function test_url_4(){
    $this->podcast->set_url('');
    $this->assertEquals('', $this->podcast->get_url());
  }

  public function test_news(){
    $news = new news();
    $this->podcast->add_news($news);
    $this->assertSame($news, $this->podcast->get_news()[0]);
  }

  public function test_showPodcast_1(){
    $this->podcast->set_showPodcast(1);
    $this->assertEquals(1, $this->podcast->get_showPodcast());
    $this->assertTrue($this->podcast->isShowPodcast());
  }

  public function test_showPodcast_2(){
    $this->podcast->set_showPodcast(0);
    $this->assertEquals(0, $this->podcast->get_showPodcast());
    $this->assertFalse($this->podcast->isShowPodcast());
  }

  public function test_showPodcast_3(){
    $this->setExpectedException('DomainException');
    $this->podcast->set_showPodcast(2);
  }

  public function test_file_url(){
    $url = 'http://pirate.rcmp.me/records/rcmp_raw_v2.2/_podcast_record_1417919340_raw.mp3';
    $this->podcast->set_file_url($url);
    $this->assertEquals($url, $this->podcast->get_file_url());
  }

  public function test_shownotes()
  {
    $shownotes = 'Тестовые shownotes';
    $this->podcast->set_shownotes($shownotes);
    $this->assertEquals($shownotes, $this->podcast->get_shownotes());
  }

  public function test_id()
  {
    $id = '123';
    $this->podcast->set_id($id);
    $this->assertEquals($id, $this->podcast->get_id());
  }
}