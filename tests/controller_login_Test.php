<?php

use Silex\Application;
use app\controllers\login as controller;
use Symfony\Component\HttpFoundation\Request;

class controller_login_Test extends PHPUnit_Framework_TestCase{

  public function setUp(){
    $twig = $this->getMockBuilder('\Twig_Environment')
                 ->disableOriginalConstructor()->getMock();
    $em = $this->getMockBuilder('\Doctrine\ORM\EntityManager')
               ->disableOriginalConstructor()->getMock();
    $this->app = new Application();
    $this->controller = new controller();
    $this->request = new Request();
    $this->app['twig'] = $twig;
    $this->app['em'] = $em;
  }

  public function test_enter(){
    $this->app['user'] = 'user_object';
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('login\enter.tpl', ['user' => $this->app['user']])
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->enter($this->app);
    $this->assertEquals('render_template', $response);
  }

  public function test_new_user(){
    $this->request->query->set('email', 'email');
    $this->request->query->set('nickname', 'nickname');
    $this->app['user'] = 'user_object';
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('login\new_user.tpl',
                             ['user' => $this->app['user'],
                              'email' => 'email', 'nickname' => 'nickname'])
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->new_user($this->request, $this->app);
    $this->assertEquals('render_template', $response);
  }

  public function test_password(){
    $this->app['user'] = 'user_object';
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('login\password.tpl', ['user' => $this->app['user']])
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->password($this->app);
    $this->assertEquals('render_template', $response);
  }

  public function test_registration_1(){
    $this->request->request->set('email', 'nekrasov@mlsco.ru');
    $this->request->request->set('nickname', 'NekrasovEV');
    $this->request->request->set('password', 'Aa123');
    $this->app['user'] = 'user_object';
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('login\wrong_password.tpl',
                             ['user' => $this->app['user'],
                              'email' => 'nekrasov@mlsco.ru',
                              'nickname' => 'NekrasovEV'])
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->registration($this->request, $this->app);
    $this->assertEquals('render_template', $response);
  }

  public function test_registration_2(){
    $this->request->request->set('email', 'nekrasov@mlsco.ru');
    $this->request->request->set('nickname', 'NekrasovEV');
    $this->request->request->set('password', 'Aa123456');
    $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
                       ->disableOriginalConstructor()
                       ->setMethods(['findOneByEmail'])
                       ->getMock();
    $repository->expects($this->once())
               ->method('findOneByEmail')
               ->with('nekrasov@mlsco.ru')
               ->will($this->returnValue('user_oject'));
    $this->app['em']->expects($this->once())
                    ->method('getRepository')
                    ->with('\app\domain\user')
                    ->will($this->returnValue($repository));
    $this->app['user'] = 'user_object';
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('login\login_busy.tpl',
                             ['user' => $this->app['user'],
                              'email' => 'nekrasov@mlsco.ru',
                              'nickname' => 'NekrasovEV'])
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->registration($this->request, $this->app);
    $this->assertEquals('render_template', $response);
  }

  public function test_registration_3(){
    $this->request->request->set('email', 'nekrasov@mlsco.ru');
    $this->request->request->set('nickname', 'NekrasovEV');
    $this->request->request->set('password', 'Aa123456');
    $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
                       ->disableOriginalConstructor()
                       ->setMethods(['findOneByEmail', 'findOneByNickname'])
                       ->getMock();
    $repository->expects($this->once())
               ->method('findOneByEmail')
               ->with('nekrasov@mlsco.ru')
               ->will($this->returnValue(null));
    $repository->expects($this->once())
               ->method('findOneByNickname')
               ->with('NekrasovEV')
               ->will($this->returnValue('user_oject'));
    $this->app['em']->expects($this->exactly(2))
                    ->method('getRepository')
                    ->with('\app\domain\user')
                    ->will($this->returnValue($repository));
    $this->app['user'] = 'user_object';
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('login\login_busy.tpl',
                             ['user' => $this->app['user'],
                              'email' => 'nekrasov@mlsco.ru',
                              'nickname' => 'NekrasovEV'])
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->registration($this->request, $this->app);
    $this->assertEquals('render_template', $response);
  }

  public function test_registration_4(){
    $this->request->request->set('email', 'nekrasov@mlsco.ru');
    $this->request->request->set('nickname', 'NekrasovEV');
    $this->request->request->set('password', 'Aa123456');
    $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')
                       ->disableOriginalConstructor()
                       ->setMethods(['findOneByEmail', 'findOneByNickname'])
                       ->getMock();
    $repository->expects($this->once())
               ->method('findOneByEmail')
               ->with('nekrasov@mlsco.ru')
               ->will($this->returnValue(null));
    $repository->expects($this->once())
               ->method('findOneByNickname')
               ->with('NekrasovEV')
               ->will($this->returnValue(null));
    $this->app['em']->expects($this->exactly(2))
                    ->method('getRepository')
                    ->with('\app\domain\user')
                    ->will($this->returnValue($repository));
    $this->app['em']->expects($this->once())
                    ->method('persist')
                    ->with($this->isInstanceOf('\app\domain\user'));
    $this->app['em']->expects($this->once())
                    ->method('flush');
    $this->app['user'] = 'user_object';
    $this->app['salt'] = 'salt';
    $this->app['twig']->expects($this->once())
                      ->method('render')
                      ->with('login\success.tpl',
                             ['user' => $this->app['user'],
                              'email' => 'nekrasov@mlsco.ru',
                              'nickname' => 'NekrasovEV'])
                      ->will($this->returnValue('render_template'));
    $response = $this->controller->registration($this->request, $this->app);
    $this->assertEquals('render_template', $response);
  }
}