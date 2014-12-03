<?php

use app\domain\user;

class controller_user_Test extends PHPUnit_Framework_TestCase{

  public function setUp(){
    $this->user = new user();
  }

  public function test_id(){
    $this->user->set_id(123);
    $this->assertEquals(123, $this->user->get_id());
  }

  public function test_hash(){
    $this->user->set_hash('f2d8e52338f6b329c0298b3b59263ec6924b07da');
    $this->assertEquals('f2d8e52338f6b329c0298b3b59263ec6924b07da',
                        $this->user->get_hash());
  }

  public function test_email_1(){
    $this->user->set_email('nekrasov@mlsco.ru');
    $this->assertEquals('nekrasov@mlsco.ru', $this->user->get_email());
  }

  public function test_email_2(){
    $this->setExpectedException('DomainException');
    $this->user->set_email('nekrasov@mlsco');
  }

  public function test_nickname_1(){
    $this->user->set_nickname('NekrasovEV');
    $this->assertEquals('NekrasovEV', $this->user->get_nickname());
  }

  public function test_nickname_2(){
    $this->user->set_nickname('Ёошкарла78');
    $this->assertEquals('Ёошкарла78', $this->user->get_nickname());
  }

  public function test_nickname_3(){
    $this->setExpectedException('DomainException');
    $this->user->set_nickname('N');
  }

  public function test_nickname_4(){
    $this->setExpectedException('DomainException');
    $this->user->set_nickname(' Nekrasov');
  }

  public function test_nickname_6(){
    $this->setExpectedException('DomainException');
    $this->user->set_nickname('');
  }
}